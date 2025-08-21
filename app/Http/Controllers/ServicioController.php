<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use App\Http\Resources\ServicioResource;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        return ServicioResource::collection(Servicio::paginate());
    }

    public function store(StoreServicioRequest $request)
    {
        $servicio = Servicio::create($request->validated());
        return (new ServicioResource($servicio))->response()->setStatusCode(201);
    }

    public function show(Servicio $servicio)
    {
        return new ServicioResource($servicio);
    }

    public function update(UpdateServicioRequest $request, Servicio $servicio)
    {
        $servicio->update($request->validated());
        return new ServicioResource($servicio);
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return response()->noContent();
    }
}
