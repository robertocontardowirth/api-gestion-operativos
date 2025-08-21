<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrigenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('calendario') ?? false;
    }

    public function rules(): array
    {
        $origen = $this->route('origen');

        return [
            'nombre' => ['sometimes','string','max:255', Rule::unique('origenes','nombre')->ignore($origen)],
        ];
    }
}
