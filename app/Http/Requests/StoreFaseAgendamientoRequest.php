<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaseAgendamientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('fases-agendamiento') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255','unique:fases_agendamiento,nombre'],
            'color'  => ['nullable','string','max:50'],
            'icono'  => ['nullable','string','max:100'],
        ];
    }
}
