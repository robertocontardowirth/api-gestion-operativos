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
        return GestionResource::collection(Gestion::with(['paciente','uploads'])->paginate());
    }

    public function store(StoreGestionRequest $request)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? [];
        unset($data['upload_ids']);

        $gestion = Gestion::create($data);
        if (!empty($uploads)) {
            $gestion->uploads()->sync($uploads);
        }

        return (new GestionResource($gestion->load(['paciente','uploads'])))->response()->setStatusCode(201);
    }

    public function show(Gestion $gestion)
    {
        return new GestionResource($gestion->load(['paciente','uploads']));
    }

    public function update(UpdateGestionRequest $request, Gestion $gestion)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? null;
        unset($data['upload_ids']);

        $gestion->update($data);
        if (!is_null($uploads)) {
            $gestion->uploads()->sync($uploads);
        }

        return new GestionResource($gestion->load(['paciente','uploads']));
    }

    public function destroy(Gestion $gestion)
    {
        $gestion->delete();
        return response()->noContent();
    }
}
