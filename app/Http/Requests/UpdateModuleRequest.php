<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('modulos') ?? false;
    }

    public function rules(): array
    {
        $module = $this->route('module');

        return [
            'nombre' => ['sometimes','string','max:255'],
            'slug'   => ['sometimes','string','max:255', Rule::unique('modules','slug')->ignore($module)],
            'url'    => ['sometimes','nullable','string','max:255'],
            'icono'  => ['sometimes','nullable','string','max:255'],
        ];
    }
}
