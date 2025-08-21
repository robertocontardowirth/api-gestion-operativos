<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrigenResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'origenes',
            'id' => (string) $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
