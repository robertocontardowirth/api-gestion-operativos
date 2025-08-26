<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasModule('uploads') ?? false;
    }

    public function rules(): array
    {
        return [
            'filename'  => ['required','string','max:255'],
            'url'       => ['required','url'],
            'mime_type' => ['nullable','string','max:50'],
            'size'      => ['nullable','integer','min:0'],
        ];
    }
}
