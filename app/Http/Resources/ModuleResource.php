<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'modules',
            'id' => (string) $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'slug' => $this->slug,
                'url' => $this->url,
                'icono' => $this->icono,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'roles' => RoleResource::collection($this->whenLoaded('roles')),
            ],
        ];
    }
}
