<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\AuthLoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{

    /**
     * Attempt login
     * @param AuthLoginRequest $request
     * @return AuthLoginResource
     * @throws ValidationException
     */
    public function login(AuthLoginRequest $request){
        $user = User::where('email', $request->email)->firstOrFail();
        if(!Hash::check($request->password, $user->password))
        {
            //ritorna un errore
            throw ValidationException::withMessages([
                'email' => 'Invalid email'
            ]);
        }

       // return response()->json(['name'=>$user->name]);
        return new AuthLoginResource($user);
    }
}
