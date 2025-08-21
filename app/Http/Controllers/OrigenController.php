<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrigenRequest;
use App\Http\Requests\UpdateOrigenRequest;
use App\Http\Resources\OrigenResource;
use App\Models\Origen;

class OrigenController extends Controller
{
    public function index()
    {
        return OrigenResource::collection(Origen::paginate());
    }

    public function store(StoreOrigenRequest $request)
    {
        $origen = Origen::create($request->validated());
        return (new OrigenResource($origen))->response()->setStatusCode(201);
    }

    public function show(Origen $origen)
    {
        return new OrigenResource($origen);
    }

    public function update(UpdateOrigenRequest $request, Origen $origen)
    {
        $origen->update($request->validated());
        return new OrigenResource($origen);
    }

    public function destroy(Origen $origen)
    {
        $origen->delete();
        return response()->noContent();
    }
}
