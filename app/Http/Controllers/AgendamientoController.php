<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendamientoRequest;
use App\Http\Requests\UpdateAgendamientoRequest;
use App\Http\Resources\AgendamientoResource;
use App\Models\Agendamiento;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;

class AgendamientoController extends Controller
{
    public function index()
    {
        return AgendamientoResource::collection(
            Agendamiento::with(['paciente','tutor','especie','fase'])->paginate()
        );
    }

    public function store(StoreAgendamientoRequest $request)
    {
        $ag = Agendamiento::create($request->validated());
        return (new AgendamientoResource($ag))->response()->setStatusCode(201);
    }

    public function show(Agendamiento $agendamiento)
    {
        return new AgendamientoResource(
            $agendamiento->load(['paciente','tutor','especie','fase','productos','servicios','pagos'])
        );
    }

    public function update(UpdateAgendamientoRequest $request, Agendamiento $agendamiento)
    {
        $agendamiento->update($request->validated());
        return new AgendamientoResource($agendamiento->fresh()->load(['paciente','tutor','especie','fase']));
    }

    public function destroy(Agendamiento $agendamiento)
    {
        $agendamiento->delete();
        return response()->noContent();
    }

    // ----------- vínculos M:M -----------
    public function attachProducto(Request $request, Agendamiento $agendamiento)
    {
        $data = $request->validate([
            'producto_id' => ['required','exists:productos,id'],
            'cantidad'    => ['sometimes','integer','min:1'],
            'precio'      => ['sometimes','numeric','min:0'],
        ]);

        $agendamiento->productos()->syncWithoutDetaching([
            $data['producto_id'] => [
                'cantidad' => $data['cantidad'] ?? 1,
                'precio'   => $data['precio'] ?? null,
            ]
        ]);

        return new AgendamientoResource($agendamiento->load('productos'));
    }

    public function detachProducto(Agendamiento $agendamiento, Producto $producto)
    {
        $agendamiento->productos()->detach($producto->id);
        return new AgendamientoResource($agendamiento->load('productos'));
    }

    public function attachServicio(Request $request, Agendamiento $agendamiento)
    {
        $data = $request->validate([
            'servicio_id' => ['required','exists:servicios,id'],
            'cantidad'    => ['sometimes','integer','min:1'],
            'precio'      => ['sometimes','numeric','min:0'],
        ]);

        $agendamiento->servicios()->syncWithoutDetaching([
            $data['servicio_id'] => [
                'cantidad' => $data['cantidad'] ?? 1,
                'precio'   => $data['precio'] ?? null,
            ]
        ]);

        return new AgendamientoResource($agendamiento->load('servicios'));
    }

    public function detachServicio(Agendamiento $agendamiento, Servicio $servicio)
    {
        $agendamiento->servicios()->detach($servicio->id);
        return new AgendamientoResource($agendamiento->load('servicios'));
    }

    public function attachPago(Request $request, Agendamiento $agendamiento)
    {
        $data = $request->validate([
            'pago_id' => ['required','exists:pagos,id'],
        ]);
        $agendamiento->pagos()->syncWithoutDetaching([$data['pago_id']]);
        return new AgendamientoResource($agendamiento->load('pagos'));
    }

    public function detachPago(Agendamiento $agendamiento, Pago $pago)
    {
        $agendamiento->pagos()->detach($pago->id);
        return new AgendamientoResource($agendamiento->load('pagos'));
    }
}
