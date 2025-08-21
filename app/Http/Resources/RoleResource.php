<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'roles',
            'id' => (string) $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'slug' => $this->slug,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'modules' => ModuleResource::collection($this->whenLoaded('modules')),
                'users'   => UserResource::collection($this->whenLoaded('users')),
            ],
        ];
    }
}
