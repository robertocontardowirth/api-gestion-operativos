<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GestionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'gestiones',
            'id' => (string) $this->id,
            'attributes' => [
                'fecha' => $this->fecha,
                'autor' => $this->autor,
                'proximo_llamado' => $this->proximo_llamado,
                'observacion' => $this->observacion,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'paciente' => new PacienteResource($this->whenLoaded('paciente')),
            ],
        ];
    }
}
