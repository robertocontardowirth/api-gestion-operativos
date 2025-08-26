<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Http\Resources\PagoResource;
use App\Models\Pago;

class PagoController extends Controller
{
    public function index()
    {
        return PagoResource::collection(Pago::with(['tipoPago','uploads'])->paginate());
    }

    public function store(StorePagoRequest $request)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? [];
        unset($data['upload_ids']);

        $pago = Pago::create($data);
        if (!empty($uploads)) {
            $pago->uploads()->sync($uploads);
        }

        return (new PagoResource($pago->load(['tipoPago','uploads'])))->response()->setStatusCode(201);
    }

    public function show(Pago $pago)
    {
        return new PagoResource($pago->load(['tipoPago','uploads']));
    }

    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? null;
        unset($data['upload_ids']);

        $pago->update($data);
        if (!is_null($uploads)) {
            $pago->uploads()->sync($uploads);
        }

        return new PagoResource($pago->load(['tipoPago','uploads']));
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return response()->noContent();
    }
}
