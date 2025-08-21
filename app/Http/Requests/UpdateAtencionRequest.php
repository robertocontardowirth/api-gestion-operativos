<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAtencionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('clinica') ?? false;
    }

    public function rules(): array
    {
        return [
            'paciente_id'  => ['sometimes','nullable','exists:pacientes,id'],
            'tutor_id'     => ['sometimes','nullable','exists:tutores,id'],
            'especie_id'   => ['sometimes','nullable','exists:especies,id'],
            'sexo'         => ['sometimes','nullable','string','max:50'],
            'peso'         => ['sometimes','nullable','numeric','min:0'],
            'edad'         => ['sometimes','nullable','integer','min:0'],
            'anestesia_id' => ['sometimes','nullable','integer','min:0'],
            'anamnesis'    => ['sometimes','nullable','string'],
            'observaciones'=> ['sometimes','nullable','string'],
        ];
    }
}
