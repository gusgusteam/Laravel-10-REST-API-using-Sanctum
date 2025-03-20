<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotaVentaResource extends JsonResource
{
    public function toArray2($request)
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'cliente_id' => $this->cliente_id,
            'user_id' => $this->user_id,
            'gestion_id' => $this->gestion_id,
            'cultivo_id' => $this->cultivo_id,
            'codigo_factura' => $this->codigo_factura,
            'fecha' => $this->fecha,
            'monto_total' => $this->monto_total,
            'lugar' => $this->lugar,
            'recibido' => $this->recibido,
            'venta_credito' => $this->venta_credito,
            'estado' => $this->estado,
           // 'created_at' => $this->created_at,
           // 'updated_at' => $this->updated_at,
        ];
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'codigo_factura' => $this->codigo_factura,
            'fecha' => $this->fecha,
            'monto_total' => $this->monto_total,
            'lugar' => $this->lugar,
            'recibido' => $this->recibido,
            'venta_credito' => $this->venta_credito,
            'estado' => $this->estado,
            'firma' => $this->firma,
            'codigo_alterno' => $this->codigo_alterno,
            'nota_alterna' => $this->nota_alterna,
            'motivo' => $this->motivo,
            'cliente' => new ClienteResource($this->whenLoaded('cliente')), 
            'user' => new UserResource($this->whenLoaded('user')), 
            'gestion' => new GestionResource($this->whenLoaded('gestion')), 
            'cultivo' => new CultivoResource($this->whenLoaded('cultivo')), 
        ];
    }
}
