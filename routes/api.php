<?php

use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\EditorialProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', [AuthController::class, 'login']);

Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
        'middleware' => ['auth:sanctum']
    ], function (){
        Route::post('editorial-projects/{id}/upload-file', [EditorialProjectController::class, 'uploadFile']);

        Route::apiResources([
            'users' => UsersController::class,
            'editorial-projects' => EditorialProjectController::class,
        ]);
    });
});


