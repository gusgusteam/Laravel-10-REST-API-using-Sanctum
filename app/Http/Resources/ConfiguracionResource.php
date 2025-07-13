<?php

namespace App\Http\Resources;

use App\Models\Gestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfiguracionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
           'nombre_empresa' => $this->nombre_empresa,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->email,
            'nit' => $this->nit,
            'razon_social' => $this->razon_social,
            'frase' => $this->frase,
            'logo' => $this->logo,
            'id_gestion' => $this->id_gestion,
            'gestion' => Gestion::find($this->id_gestion),
        ];
    }
}
