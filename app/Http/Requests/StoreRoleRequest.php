<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('roles') ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:255'],
            'slug'   => ['required','string','max:255','unique:roles,slug'],
        ];
    }
}
