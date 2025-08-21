<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pacientes') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes','string','max:255'],
        ];
    }
}
