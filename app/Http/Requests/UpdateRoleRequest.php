<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('roles') ?? false;
    }

    public function rules(): array
    {
        $role = $this->route('role');

        return [
            'nombre' => ['sometimes','string','max:255'],
            'slug'   => ['sometimes','string','max:255', Rule::unique('roles','slug')->ignore($role)],
        ];
    }
}
