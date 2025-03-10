<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'nombre_corto' => $this->nombre_corto,
            'estado' => $this->estado,
            //'created_at' => $this->created_at->format('d/m/Y'),
            //'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
