<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTipoPagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pagos') ?? false;
    }

    public function rules(): array
    {
        $tipo = $this->route('tipo_pago');

        return [
            'nombre' => ['sometimes','string','max:255', Rule::unique('tipos_pago','nombre')->ignore($tipo)],
        ];
    }
}
