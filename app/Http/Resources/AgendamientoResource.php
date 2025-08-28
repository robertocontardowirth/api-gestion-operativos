<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendamientoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'agendamientos',
            'id' => (string) $this->id,
            'attributes' => [
                'contacto' => $this->contacto,
                'aprobacion' => $this->aprobacion,
                'cita' => $this->cita,
                'llegada' => $this->llegada,
                'evaluacion' => $this->evaluacion,
                'pabellon' => $this->pabellon,
                'pago' => $this->pago,
                'salida' => $this->salida,
                'sexo' => $this->sexo,
                'peso' => $this->peso,
                'edad' => $this->edad,
                'anestesia_id' => $this->anestesia_id,
                'abono' => $this->abono,
                'consentimiento' => $this->consentimiento,
                'total' => $this->total,
                'observaciones' => $this->observaciones,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'paciente'  => new PacienteResource($this->whenLoaded('paciente')),
                'tutor'     => new TutorResource($this->whenLoaded('tutor')),
                'especie'   => new EspecieResource($this->whenLoaded('especie')),
                'fase'      => new FaseAgendamientoResource($this->whenLoaded('fase')),
                'productos' => ProductoResource::collection($this->whenLoaded('productos')),
                'servicios' => ServicioResource::collection($this->whenLoaded('servicios')),
                'pagos'     => PagoResource::collection($this->whenLoaded('pagos')),
                'uploads'   => UploadResource::collection($this->whenLoaded('uploads')),
                'operativos' => OperativoResource::collection($this->whenLoaded('operativos')),
            ],
        ];
    }
}
