<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendamientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('calendario') ?? false;
    }

    public function rules(): array
    {
        return [
            'origen_id'   => ['nullable','exists:origenes,id'],
            'fase_id'     => ['nullable','exists:fases_agendamiento,id'],
            'paciente_id' => ['nullable','exists:pacientes,id'],
            'tutor_id'    => ['nullable','exists:tutores,id'],
            'atencion_id' => ['nullable','exists:atenciones,id'],

            'contacto'    => ['nullable','string','max:255'],
            'aprobacion'  => ['nullable','date'],
            'cita'        => ['nullable','date'],
            'llegada'     => ['nullable','date'],
            'evaluacion'  => ['nullable','date'],
            'pabellon'    => ['nullable','date'],
            'pago'        => ['nullable','date'],
            'salida'      => ['nullable','date'],

            'especie_id'  => ['nullable','exists:especies,id'],
            'sexo'        => ['nullable','string','max:50'],
            'peso'        => ['nullable','numeric','min:0'],
            'edad'        => ['nullable','integer','min:0'],
            'anestesia_id'=> ['nullable','integer','min:0'],

            'abono'          => ['boolean'],
            'consentimiento' => ['boolean'],
            'total'          => ['numeric','min:0'],
            'observaciones'  => ['nullable','string'],
        ];
    }
}
