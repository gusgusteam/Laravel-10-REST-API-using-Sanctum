<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GestionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'anio' => $this->anio,
            'nombre_campania' => $this->nombre_campania,
            'gestion_actual' => $this->gestion_actual,
            'estado' => $this->estado,
        ];
    }
}

