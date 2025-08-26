<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('tutores') ?? false;
    }

    public function rules(): array
    {
        return [
            'rut'        => ['nullable','string','max:50'],
            'nombres'    => ['required','string','max:255'],
            'apellidos'  => ['nullable','string','max:255'],
            'email'      => ['nullable','email','max:255'],
            'telefono_1' => ['nullable','string','max:50'],
            'telefono_2' => ['nullable','string','max:50'],
            'upload_ids' => ['array'],
            'upload_ids.*' => ['exists:uploads,id'],
        ];
    }
}
