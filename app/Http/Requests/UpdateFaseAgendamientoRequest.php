<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFaseAgendamientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('fases-agendamiento') ?? false;
    }

    public function rules(): array
    {
        $fase = $this->route('fase_agendamiento') ?? $this->route('fase');

        return [
            'nombre' => ['sometimes','string','max:255', Rule::unique('fases_agendamiento','nombre')->ignore($fase)],
            'color'  => ['sometimes','nullable','string','max:50'],
            'icono'  => ['sometimes','nullable','string','max:100'],
        ];
    }
}
