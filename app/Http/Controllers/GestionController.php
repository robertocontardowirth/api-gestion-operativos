<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGestionRequest;
use App\Http\Requests\UpdateGestionRequest;
use App\Http\Resources\GestionResource;
use App\Models\Gestion;

class GestionController extends Controller
{
    public function index()
    {
        return GestionResource::collection(Gestion::with('paciente')->paginate());
    }

    public function store(StoreGestionRequest $request)
    {
        $gestion = Gestion::create($request->validated());
        return (new GestionResource($gestion))->response()->setStatusCode(201);
    }

    public function show(Gestion $gestion)
    {
        return new GestionResource($gestion->load('paciente'));
    }

    public function update(UpdateGestionRequest $request, Gestion $gestion)
    {
        $gestion->update($request->validated());
        return new GestionResource($gestion->load('paciente'));
    }

    public function destroy(Gestion $gestion)
    {
        $gestion->delete();
        return response()->noContent();
    }
}
