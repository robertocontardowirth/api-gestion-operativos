<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtencionRequest;
use App\Http\Requests\UpdateAtencionRequest;
use App\Http\Resources\AtencionResource;
use App\Models\Atencion;

class AtencionController extends Controller
{
    public function index()
    {
        return AtencionResource::collection(
            Atencion::with(['paciente','tutor','especie','uploads'])->paginate()
        );
    }

    public function store(StoreAtencionRequest $request)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? [];
        unset($data['upload_ids']);

        $atencion = Atencion::create($data);
        if (!empty($uploads)) {
            $atencion->uploads()->sync($uploads);
        }

        return (new AtencionResource($atencion->load('uploads')))->response()->setStatusCode(201);
    }

    public function show(Atencion $atencione)
    {
        return new AtencionResource($atencione->load(['paciente','tutor','especie','uploads']));
    }

    public function update(UpdateAtencionRequest $request, Atencion $atencione)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? null;
        unset($data['upload_ids']);

        $atencione->update($data);
        if (!is_null($uploads)) {
            $atencione->uploads()->sync($uploads);
        }

        return new AtencionResource($atencione->load(['paciente','tutor','especie','uploads']));
    }

    public function destroy(Atencion $atencione)
    {
        $atencione->delete();
        return response()->noContent();
    }
}
