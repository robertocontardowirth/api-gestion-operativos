<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAtencionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('clinica') ?? false;
    }

    public function rules(): array
    {
        return [
            'paciente_id'  => ['nullable','exists:pacientes,id'],
            'tutor_id'     => ['nullable','exists:tutores,id'],
            'especie_id'   => ['nullable','exists:especies,id'],
            'sexo'         => ['nullable','string','max:50'],
            'peso'         => ['nullable','numeric','min:0'],
            'edad'         => ['nullable','integer','min:0'],
            'anestesia_id' => ['nullable','integer','min:0'],
            'anamnesis'    => ['nullable','string'],
            'observaciones'=> ['nullable','string'],
            'upload_ids' => ['array'],
            'upload_ids.*' => ['exists:uploads,id'],
        ];
    }
}
