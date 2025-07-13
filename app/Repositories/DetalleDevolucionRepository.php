<?php

namespace App\Repositories;

use App\Models\DetalleDevolucion;

class DetalleDevolucionRepository
{
    public function getAll($id_NotaDevolucion)
    {
        return DetalleDevolucion::all();
    }

    public function find($id)
    {
        return DetalleDevolucion::findOrFail($id);
    }

    public function create(array $data)
    {
        $detalleDevolucion = new DetalleDevolucion($data);
        if (!$detalleDevolucion->save()) {
            return false;
        }
        return true;
    }

    public function aumentar_producto($id)
    {
        $detalleDevolucion = $this->find($id);
        $detalleDevolucion['cantidad'] += 1;
        if ($detalleDevolucion->update()) {
            return true;
        }
        return false;
    }
    public function restar_producto($id)
    {
        $detalleDevolucion = $this->find($id);
        $detalleDevolucion['cantidad'] -= 1;
        if ($detalleDevolucion->update()) {
            return true;
        }
        return false;
    }

    public function delete(array $data)
    {
        $detalleDevolucion = $this->find($data['id']);
        if ($detalleDevolucion->delete()) {
            return true;
        }
        return false;
    }
    
    public function update($id, array $data)
    {
        $detalleDevolucion = $this->find($id);
        if ($detalleDevolucion->update($data)) {
            return true;
        }
        return false;
    }
}
