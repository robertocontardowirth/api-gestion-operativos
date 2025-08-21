<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'pacientes',
            'id' => (string) $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
