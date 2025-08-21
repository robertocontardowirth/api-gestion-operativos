<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pacientes') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255'],
        ];
    }
}
