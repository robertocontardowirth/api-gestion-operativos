<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('servicios') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes','string','max:255'],
            'precio' => ['sometimes','numeric','min:0'],
        ];
    }
}
