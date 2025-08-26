<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PagoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'pagos',
            'id' => (string) $this->id,
            'attributes' => [
                'monto' => $this->monto,
                'fecha_pago' => $this->fecha_pago,
                'observacion' => $this->observacion,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'tipo_pago' => new TipoPagoResource($this->whenLoaded('tipoPago')),
                'uploads'   => UploadResource::collection($this->whenLoaded('uploads')),
            ],
        ];
    }
}
