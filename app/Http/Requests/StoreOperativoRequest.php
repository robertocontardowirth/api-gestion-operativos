<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperativoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('operativos') ?? false;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required','string','max:255'],
            'descripcion' => ['required','string','max:255'],
            'fecha_inicio' => ['required','date'],
            'fecha_termino' => ['required','date'],
            'agendamiento_ids' => ['array'],
            'agendamiento_ids.*' => ['exists:agendamientos,id'],
        ];
    }
}
