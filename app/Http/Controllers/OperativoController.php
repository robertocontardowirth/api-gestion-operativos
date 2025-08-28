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
        return OperativoResource::collection(Operativo::with('agendamientos')->paginate());
    }

    public function store(StoreOperativoRequest $request)
    {
        $data = $request->validated();
        $agendamientos = $data['agendamiento_ids'] ?? [];
        unset($data['agendamiento_ids']);

        $operativo = Operativo::create($data);
        if (!empty($agendamientos)) {
            $operativo->agendamientos()->sync($agendamientos);
        }

        return (new OperativoResource($operativo->load('agendamientos')))->response()->setStatusCode(201);
    }

    public function show(Operativo $operativo)
    {
        return new OperativoResource($operativo->load('agendamientos'));
    }

    public function update(UpdateOperativoRequest $request, Operativo $operativo)
    {
        $data = $request->validated();
        $agendamientos = $data['agendamiento_ids'] ?? null;
        unset($data['agendamiento_ids']);

        $operativo->update($data);
        if (!is_null($agendamientos)) {
            $operativo->agendamientos()->sync($agendamientos);
        }

        return new OperativoResource($operativo->load('agendamientos'));
    }

    public function destroy(Operativo $operativo)
    {
        $operativo->delete();
        return response()->noContent();
    }
}
