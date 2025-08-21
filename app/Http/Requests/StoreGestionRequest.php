<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('calendario') ?? false;
    }

    public function rules(): array
    {
        return [
            'paciente_id'     => ['nullable','exists:pacientes,id'],
            'fecha'           => ['nullable','date'],
            'autor'           => ['nullable','string','max:255'],
            'proximo_llamado' => ['nullable','date'],
            'observacion'     => ['nullable','string'],
        ];
    }
}
