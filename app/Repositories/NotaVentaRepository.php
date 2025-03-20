<?php

namespace App\Repositories;

use App\Models\NotaVenta;

class NotaVentaRepository
{
    public function all()
    {
        return NotaVenta::with(['cliente', 'user', 'gestion', 'cultivo'])->get();
    }

    public function find($id)
    {
        return NotaVenta::with(['cliente', 'user', 'gestion', 'cultivo'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return NotaVenta::create($data);
    }

    public function update($id, array $data)
    {
        $notaVenta = $this->find($id);
        if(!$notaVenta->firma){
            if($notaVenta->update($data)){
                return true;
            } 
        }
        return false;
    }

    public function completar_firma($id)
    {
        $notaVenta = $this->find($id);
        if(!$notaVenta->firma){
            $notaVenta->firma = 1;
            if($notaVenta->update()){
                return true;
            } 
        }
        return false;
    }

    public function anular_nota(array $data) // anula nota y no lo elimina de la base de datos
    {
        $codigo_factura = $data['codigo_factura'];
        $motivo = $data['motivo'];
        $notaVenta = NotaVenta::where('codigo_factura', $codigo_factura)->first();
        if($notaVenta){
            $notaVenta->codigo_alterno = $notaVenta->codigo_factura;
            $notaVenta->codigo_factura = $notaVenta->codigo_factura .'-'.$notaVenta->id.'-ANULADO';
            $notaVenta->nota_alterna = 1; 
            $notaVenta->motivo = $motivo;
            if($notaVenta->update()){
                return true;
            } 
        }
        
        return false;
    }
}