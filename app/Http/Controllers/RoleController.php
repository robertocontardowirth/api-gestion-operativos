<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::with('modules')->paginate());
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        return (new RoleResource($role))->response()->setStatusCode(201);
    }

    public function show(Role $role)
    {
        return new RoleResource($role->load('modules'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->noContent();
    }

    // ---------- módulos de un rol ----------
    public function syncModules(Request $request, Role $role)
    {
        $data = $request->validate([
            'slugs' => ['array'],
            'slugs.*' => ['string', 'exists:modules,slug'],
        ]);
        $ids = Module::whereIn('slug', $data['slugs'] ?? [])->pluck('id');
        $role->modules()->sync($ids);
        return new RoleResource($role->load('modules'));
    }

    public function attachModule(Role $role, Module $module)
    {
        $role->modules()->syncWithoutDetaching([$module->id]);
        return new RoleResource($role->load('modules'));
    }

    public function detachModule(Role $role, Module $module)
    {
        $role->modules()->detach($module->id);
        return new RoleResource($role->load('modules'));
    }
}
