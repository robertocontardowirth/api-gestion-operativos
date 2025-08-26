<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('uploads') ?? false;
    }

    public function rules(): array
    {
        return [
            'filename'  => ['sometimes','string','max:255'],
            'url'       => ['sometimes','url'],
            'mime_type' => ['sometimes','nullable','string','max:50'],
            'size'      => ['sometimes','nullable','integer','min:0'],
        ];
    }
}
