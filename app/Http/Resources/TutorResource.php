<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'tutores',
            'id' => (string) $this->id,
            'attributes' => [
                'rut' => $this->rut,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'email' => $this->email,
                'telefono_1' => $this->telefono_1,
                'telefono_2' => $this->telefono_2,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'uploads' => UploadResource::collection($this->whenLoaded('uploads')),
            ],
        ];
    }
}
