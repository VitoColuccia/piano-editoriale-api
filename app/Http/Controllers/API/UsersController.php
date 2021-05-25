<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserIndexResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(UserIndexRequest $request)
    {

        $users = User::query();

        $per_page = $request->query('per_page') ?: 5;
        $users = $users->paginate((int)$per_page);

        //Filter by text
        if($text = $request->query('text')){
            $users->where(function ($query) use ($text){
                $query->where('title','like', '%'.$text.'%')
                    ->orWhere('email', 'like', '%' . $text . '%');
            });
        }

        // Filter by trashed
        if ($request->has('trashed')) {
            switch ($request->query('trashed')) {
                case 'with':
                    $users->withTrashed();
                    break;
                case 'only':
                    $users->onlyTrashed();
                    break;
                default:
                    $users->withTrashed();
            }
        }

        if($request->has('with')) {
            $users->load($request->query('with'));
        }

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return UserResource
     * @throws Exception
     */
    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->roles()->attach(Role::find($request->role_id));

            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(UserShowRequest $request, User $user): UserResource
    {
        // Include relationship
        if ($request->query('with')) {
            $user->load($request->query('with'));
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        DB::beginTransaction();

        try {

            $user->update($request->only(['name', 'email']));

            if ($request->has('role_id')) {
                $user->roles()->sync([$request->role_id]);
            }

            DB::commit();
        } catch (Exception $exception) {

            DB::rollBack();
            throw $exception;
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserDestroyRequest $request
     * @param User $user
     * @return Response
     */
    public function destroy(UserDestroyRequest $request, User $user): Response
    {
        $user->delete();

        return response(null, 204);
    }
}
