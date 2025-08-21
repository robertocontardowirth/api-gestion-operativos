<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index()
    {
        return PacienteResource::collection(Paciente::paginate());
    }

    public function store(StorePacienteRequest $request)
    {
        $paciente = Paciente::create($request->validated());
        return (new PacienteResource($paciente))->response()->setStatusCode(201);
    }

    public function show(Paciente $paciente)
    {
        return new PacienteResource($paciente);
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->validated());
        return new PacienteResource($paciente);
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->noContent();
    }
}
