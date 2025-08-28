<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperativoRequest;
use App\Http\Requests\UpdateOperativoRequest;
use App\Http\Resources\OperativoResource;
use App\Models\Operativo;

class OperativoController extends Controller
{
    public function index()
    {
        return OperativoResource::collection(Operativo::with(['agendamientos','uploads'])->paginate());
    }

    public function store(StoreOperativoRequest $request)
    {
        $data = $request->validated();
        $agendamientos = $data['agendamiento_ids'] ?? [];
        $uploads = $data['upload_ids'] ?? [];
        unset($data['agendamiento_ids'], $data['upload_ids']);

        $operativo = Operativo::create($data);
        if (!empty($agendamientos)) {
            $operativo->agendamientos()->sync($agendamientos);
        }
        if (!empty($uploads)) {
            $operativo->uploads()->sync($uploads);
        }

        return (new OperativoResource($operativo->load(['agendamientos','uploads'])))->response()->setStatusCode(201);
    }

    public function show(Operativo $operativo)
    {
        return new OperativoResource($operativo->load(['agendamientos','uploads']));
    }

    public function update(UpdateOperativoRequest $request, Operativo $operativo)
    {
        $data = $request->validated();
        $agendamientos = $data['agendamiento_ids'] ?? null;
        $uploads = $data['upload_ids'] ?? null;
        unset($data['agendamiento_ids'], $data['upload_ids']);

        $operativo->update($data);
        if (!is_null($agendamientos)) {
            $operativo->agendamientos()->sync($agendamientos);
        }
        if (!is_null($uploads)) {
            $operativo->uploads()->sync($uploads);
        }

        return new OperativoResource($operativo->load(['agendamientos','uploads']));
    }

    public function destroy(Operativo $operativo)
    {
        $operativo->delete();
        return response()->noContent();
    }
}
