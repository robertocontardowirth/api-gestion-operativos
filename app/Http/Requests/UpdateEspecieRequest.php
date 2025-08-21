<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEspecieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pacientes') ?? false;
    }

    public function rules(): array
    {
        $especie = $this->route('especy') ?? $this->route('especie'); // por si cambia el nombre

        return [
            'nombre' => ['sometimes','string','max:255', Rule::unique('especies','nombre')->ignore($especie)],
        ];
    }
}
