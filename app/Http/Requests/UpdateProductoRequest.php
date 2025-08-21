<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('productos') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes','string','max:255'],
            'precio' => ['sometimes','numeric','min:0'],
        ];
    }
}
