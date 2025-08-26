<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendamientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('calendario') ?? false;
    }

    public function rules(): array
    {
        return [
            'origen_id'   => ['sometimes','nullable','exists:origenes,id'],
            'fase_id'     => ['sometimes','nullable','exists:fases_agendamiento,id'],
            'paciente_id' => ['sometimes','nullable','exists:pacientes,id'],
            'tutor_id'    => ['sometimes','nullable','exists:tutores,id'],
            'atencion_id' => ['sometimes','nullable','exists:atenciones,id'],

            'contacto'    => ['sometimes','nullable','string','max:255'],
            'aprobacion'  => ['sometimes','nullable','date'],
            'cita'        => ['sometimes','nullable','date'],
            'llegada'     => ['sometimes','nullable','date'],
            'evaluacion'  => ['sometimes','nullable','date'],
            'pabellon'    => ['sometimes','nullable','date'],
            'pago'        => ['sometimes','nullable','date'],
            'salida'      => ['sometimes','nullable','date'],

            'especie_id'  => ['sometimes','nullable','exists:especies,id'],
            'sexo'        => ['sometimes','nullable','string','max:50'],
            'peso'        => ['sometimes','nullable','numeric','min:0'],
            'edad'        => ['sometimes','nullable','integer','min:0'],
            'anestesia_id'=> ['sometimes','nullable','integer','min:0'],

            'abono'          => ['sometimes','boolean'],
            'consentimiento' => ['sometimes','boolean'],
            'total'          => ['sometimes','numeric','min:0'],
            'observaciones'  => ['sometimes','nullable','string'],
            'upload_ids' => ['sometimes','array'],
            'upload_ids.*' => ['exists:uploads,id'],
        ];
    }
}
