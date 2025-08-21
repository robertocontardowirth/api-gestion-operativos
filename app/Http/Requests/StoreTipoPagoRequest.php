<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoPagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pagos') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255','unique:tipos_pago,nombre'],
        ];
    }
}
