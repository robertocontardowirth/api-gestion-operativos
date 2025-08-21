<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'productos',
            'id' => (string) $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'precio' => $this->precio,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
