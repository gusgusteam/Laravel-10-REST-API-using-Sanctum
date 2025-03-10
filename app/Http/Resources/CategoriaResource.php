<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'estado' => $this->estado,
            //'created_at' => $this->created_at->format('d/m/Y'),
            //'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

