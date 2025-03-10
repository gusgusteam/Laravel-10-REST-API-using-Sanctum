<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'paterno' => $this->paterno,
            'materno' => $this->materno,
            'ci' => $this->ci,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'estado' => $this->estado,
        ];
    }
}

