<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotaCompraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'codigo_factura' => $this->codigo_factura,
            'fecha' => $this->fecha,
            'monto_total' => $this->monto_total,
            'lugar' => $this->lugar,
            'recibido' => $this->recibido,
            'compra_credito' => $this->compra_credito,
            'estado' => $this->estado,
            'firma' => $this->firma,
            'codigo_alterno' => $this->codigo_alterno,
            'nota_alterna' => $this->nota_alterna,
            'motivo' => $this->motivo,
            'user' => new UserResource($this->whenLoaded('user')), 
            'gestion' => new GestionResource($this->whenLoaded('gestion')), 
            'proveedor' => new ProveedorResource($this->whenLoaded('proveedor')), 
        ];
    }
}
