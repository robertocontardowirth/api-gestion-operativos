<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('usuarios') ?? false;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'rut'       => ['sometimes','nullable','string','max:50', Rule::unique('users','rut')->ignore($user)],
            'nombre'    => ['sometimes','string','max:255'],
            'apellidos' => ['sometimes','nullable','string','max:255'],
            'email'     => ['sometimes','email','max:255', Rule::unique('users','email')->ignore($user)],
            'telefono'  => ['sometimes','nullable','string','max:50'],
            'password'  => ['sometimes','string','min:8'],
            'role_slugs'   => ['sometimes','array'],
            'role_slugs.*' => ['string','exists:roles,slug'],
        ];
    }
}
