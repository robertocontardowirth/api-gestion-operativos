<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperativoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('operativos') ?? false;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['sometimes','string','max:255'],
            'descripcion' => ['sometimes','string','max:255'],
            'fecha_inicio' => ['sometimes','date'],
            'fecha_termino' => ['sometimes','date'],
            'agendamiento_ids' => ['array'],
            'agendamiento_ids.*' => ['exists:agendamientos,id'],
        ];
    }
}
