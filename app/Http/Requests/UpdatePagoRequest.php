<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('pagos') ?? false;
    }

    public function rules(): array
    {
        return [
            'tipo_pago_id' => ['sometimes','exists:tipos_pago,id'],
            'monto'        => ['sometimes','numeric','min:0'],
            'fecha_pago'   => ['sometimes','nullable','date'],
            'observacion'  => ['sometimes','nullable','string','max:255'],
            'upload_ids' => ['sometimes','array'],
            'upload_ids.*' => ['exists:uploads,id'],
        ];
    }
}
