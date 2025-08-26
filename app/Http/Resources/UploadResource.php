<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'uploads',
            'id' => (string) $this->id,
            'attributes' => [
                'filename' => $this->filename,
                'url' => $this->url,
                'mime_type' => $this->mime_type,
                'size' => $this->size,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
