<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::with('roles')->paginate());
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $roles = collect($data['role_slugs'] ?? []);
        unset($data['role_slugs']);

        $user = User::create($data);

        if ($roles->isNotEmpty()) {
            $roleIds = Role::whereIn('slug', $roles)->pluck('id');
            $user->roles()->sync($roleIds);
        }

        return (new UserResource($user->load('roles')))->response()->setStatusCode(201);
    }

    public function show(User $user)
    {
        return new UserResource($user->load('roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $roles = collect($data['role_slugs'] ?? null);
        unset($data['role_slugs']);

        $user->update($data);

        if (!is_null($roles)) {
            $roleIds = Role::whereIn('slug', $roles)->pluck('id');
            $user->roles()->sync($roleIds);
        }

        return new UserResource($user->load('roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
