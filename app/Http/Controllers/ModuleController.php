<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        return ModuleResource::collection(Module::paginate());
    }

    public function store(StoreModuleRequest $request)
    {
        $module = Module::create($request->validated());
        return (new ModuleResource($module))->response()->setStatusCode(201);
    }

    public function show(Module $module)
    {
        return new ModuleResource($module);
    }

    public function update(UpdateModuleRequest $request, Module $module)
    {
        $module->update($request->validated());
        return new ModuleResource($module);
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return response()->noContent();
    }
}
