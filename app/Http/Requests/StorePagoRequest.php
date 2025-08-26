<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pagos') ?? false;
    }

    public function rules(): array
    {
        return [
            'tipo_pago_id' => ['required','exists:tipos_pago,id'],
            'monto'        => ['required','numeric','min:0'],
            'fecha_pago'   => ['nullable','date'],
            'observacion'  => ['nullable','string','max:255'],
            'upload_ids' => ['array'],
            'upload_ids.*' => ['exists:uploads,id'],
        ];
    }
}
