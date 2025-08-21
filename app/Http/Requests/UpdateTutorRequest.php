<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('tutores') ?? false;
    }

    public function rules(): array
    {
        return [
            'rut'        => ['sometimes','nullable','string','max:50'],
            'nombres'    => ['sometimes','string','max:255'],
            'apellidos'  => ['sometimes','nullable','string','max:255'],
            'email'      => ['sometimes','nullable','email','max:255'],
            'telefono_1' => ['sometimes','nullable','string','max:50'],
            'telefono_2' => ['sometimes','nullable','string','max:50'],
        ];
    }
}
