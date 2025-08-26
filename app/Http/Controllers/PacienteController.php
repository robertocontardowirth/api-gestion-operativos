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
        return PacienteResource::collection(Paciente::with('uploads')->paginate());
    }

    public function store(StorePacienteRequest $request)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? [];
        unset($data['upload_ids']);

        $paciente = Paciente::create($data);
        if (!empty($uploads)) {
            $paciente->uploads()->sync($uploads);
        }

        return (new PacienteResource($paciente->load('uploads')))->response()->setStatusCode(201);
    }

    public function show(Paciente $paciente)
    {
        return new PacienteResource($paciente->load('uploads'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? null;
        unset($data['upload_ids']);

        $paciente->update($data);
        if (!is_null($uploads)) {
            $paciente->uploads()->sync($uploads);
        }

        return new PacienteResource($paciente->load('uploads'));
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->noContent();
    }
}
