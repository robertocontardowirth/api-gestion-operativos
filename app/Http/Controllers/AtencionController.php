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
            Atencion::with(['paciente','tutor','especie'])->paginate()
        );
    }

    public function store(StoreAtencionRequest $request)
    {
        $atencion = Atencion::create($request->validated());
        return (new AtencionResource($atencion))->response()->setStatusCode(201);
    }

    public function show(Atencion $atencione)
    {
        return new AtencionResource($atencione->load(['paciente','tutor','especie']));
    }

    public function update(UpdateAtencionRequest $request, Atencion $atencione)
    {
        $atencione->update($request->validated());
        return new AtencionResource($atencione->load(['paciente','tutor','especie']));
    }

    public function destroy(Atencion $atencione)
    {
        $atencione->delete();
        return response()->noContent();
    }
}
