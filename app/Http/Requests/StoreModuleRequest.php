<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('modulos') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255'],
            'slug'   => ['required','string','max:255','unique:modules,slug'],
            'url'    => ['nullable','string','max:255'],
            'icono'  => ['nullable','string','max:255'],
        ];
    }
}
