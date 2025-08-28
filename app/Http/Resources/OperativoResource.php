<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OperativoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'operativos',
            'id' => (string) $this->id,
            'attributes' => [
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_termino' => $this->fecha_termino,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'agendamientos' => AgendamientoResource::collection($this->whenLoaded('agendamientos')),
            ],
        ];
    }
}
