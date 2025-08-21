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
        return PagoResource::collection(Pago::with('tipoPago')->paginate());
    }

    public function store(StorePagoRequest $request)
    {
        $pago = Pago::create($request->validated());
        return (new PagoResource($pago))->response()->setStatusCode(201);
    }

    public function show(Pago $pago)
    {
        return new PagoResource($pago->load('tipoPago'));
    }

    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        $pago->update($request->validated());
        return new PagoResource($pago->load('tipoPago'));
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return response()->noContent();
    }
}
