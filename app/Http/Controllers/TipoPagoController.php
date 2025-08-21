<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoPagoRequest;
use App\Http\Requests\UpdateTipoPagoRequest;
use App\Http\Resources\TipoPagoResource;
use App\Models\TipoPago;

class TipoPagoController extends Controller
{
    public function index()
    {
        return TipoPagoResource::collection(TipoPago::paginate());
    }

    public function store(StoreTipoPagoRequest $request)
    {
        $tipo = TipoPago::create($request->validated());
        return (new TipoPagoResource($tipo))->response()->setStatusCode(201);
    }

    public function show(TipoPago $tipos_pago)
    {
        return new TipoPagoResource($tipos_pago);
    }

    public function update(UpdateTipoPagoRequest $request, TipoPago $tipos_pago)
    {
        $tipos_pago->update($request->validated());
        return new TipoPagoResource($tipos_pago);
    }

    public function destroy(TipoPago $tipos_pago)
    {
        $tipos_pago->delete();
        return response()->noContent();
    }
}
