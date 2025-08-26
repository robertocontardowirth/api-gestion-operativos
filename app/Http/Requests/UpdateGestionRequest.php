<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('calendario') ?? false;
    }

    public function rules(): array
    {
        return [
            'paciente_id'     => ['sometimes','nullable','exists:pacientes,id'],
            'fecha'           => ['sometimes','nullable','date'],
            'autor'           => ['sometimes','nullable','string','max:255'],
            'proximo_llamado' => ['sometimes','nullable','date'],
            'observacion'     => ['sometimes','nullable','string'],
            'upload_ids' => ['sometimes','array'],
            'upload_ids.*' => ['exists:uploads,id'],
        ];
    }
}
