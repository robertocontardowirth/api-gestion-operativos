<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AtencionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'atenciones',
            'id' => (string) $this->id,
            'attributes' => [
                'sexo' => $this->sexo,
                'peso' => $this->peso,
                'edad' => $this->edad,
                'anestesia_id' => $this->anestesia_id,
                'anamnesis' => $this->anamnesis,
                'observaciones' => $this->observaciones,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'paciente' => new PacienteResource($this->whenLoaded('paciente')),
                'tutor'    => new TutorResource($this->whenLoaded('tutor')),
                'especie'  => new EspecieResource($this->whenLoaded('especie')),
            ],
        ];
    }
}
