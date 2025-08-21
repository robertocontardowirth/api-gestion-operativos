<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('usuarios') ?? false;
    }

    public function rules(): array
    {
        return [
            'rut'       => ['nullable','string','max:50','unique:users,rut'],
            'nombre'    => ['required','string','max:255'],
            'apellidos' => ['nullable','string','max:255'],
            'email'     => ['required','email','max:255','unique:users,email'],
            'telefono'  => ['nullable','string','max:50'],
            'password'  => ['required','string','min:8'],
            'role_slugs'   => ['array'],
            'role_slugs.*' => ['string','exists:roles,slug'],
        ];
    }
}
