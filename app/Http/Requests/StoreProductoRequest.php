<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('productos') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255'],
            'precio' => ['required','numeric','min:0'],
        ];
    }
}
