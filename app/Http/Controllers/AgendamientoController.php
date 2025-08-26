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
            Agendamiento::with(['paciente','tutor','especie','fase','uploads'])->paginate()
        );
    }

    public function store(StoreAgendamientoRequest $request)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? [];
        unset($data['upload_ids']);

        $ag = Agendamiento::create($data);
        if (!empty($uploads)) {
            $ag->uploads()->sync($uploads);
        }

        return (new AgendamientoResource($ag->load('uploads')))->response()->setStatusCode(201);
    }

    public function show(Agendamiento $agendamiento)
    {
        return new AgendamientoResource(
            $agendamiento->load(['paciente','tutor','especie','fase','productos','servicios','pagos','uploads'])
        );
    }

    public function update(UpdateAgendamientoRequest $request, Agendamiento $agendamiento)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? null;
        unset($data['upload_ids']);

        $agendamiento->update($data);
        if (!is_null($uploads)) {
            $agendamiento->uploads()->sync($uploads);
        }

        return new AgendamientoResource($agendamiento->fresh()->load(['paciente','tutor','especie','fase','uploads']));
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
