<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaseAgendamientoRequest;
use App\Http\Requests\UpdateFaseAgendamientoRequest;
use App\Http\Resources\FaseAgendamientoResource;
use App\Models\FaseAgendamiento;

class FaseAgendamientoController extends Controller
{
    public function index()
    {
        return FaseAgendamientoResource::collection(FaseAgendamiento::paginate());
    }

    public function store(StoreFaseAgendamientoRequest $request)
    {
        $fase = FaseAgendamiento::create($request->validated());
        return (new FaseAgendamientoResource($fase))->response()->setStatusCode(201);
    }

    public function show(FaseAgendamiento $fases_agendamiento)
    {
        return new FaseAgendamientoResource($fases_agendamiento);
    }

    public function update(UpdateFaseAgendamientoRequest $request, FaseAgendamiento $fases_agendamiento)
    {
        $fases_agendamiento->update($request->validated());
        return new FaseAgendamientoResource($fases_agendamiento);
    }

    public function destroy(FaseAgendamiento $fases_agendamiento)
    {
        $fases_agendamiento->delete();
        return response()->noContent();
    }
}
