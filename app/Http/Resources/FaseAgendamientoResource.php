<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaseAgendamientoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'fases-agendamiento',
            'id' => (string) $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'color' => $this->color,
                'icono' => $this->icono,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
