<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrigenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('calendario') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255','unique:origenes,nombre'],
        ];
    }
}
