<?php

namespace App\Repositories;

use App\Models\DetalleVenta;

class DetalleVentaRepository
{
    public function getAll($id_NotaVenta)
    {
        return DetalleVenta::all();
    }

    public function find($id)
    {
        return DetalleVenta::findOrFail($id);
    }

    public function create(array $data)
    {
        $detalleVenta = new DetalleVenta($data);
        if (!$detalleVenta->save()) {
            return false;
        }
        return true;
    }

    public function aumentar_producto($id)
    {
        $detalleVenta = $this->find($id);
        $detalleVenta['cantidad'] += 1;
        if ($detalleVenta->update()) {
            return true;
        }
        return false;
    }
    public function restar_producto($id)
    {
        $detalleVenta = $this->find($id);
        $detalleVenta['cantidad'] -= 1;
        if ($detalleVenta->update()) {
            return true;
        }
        return false;
    }

    public function delete(array $data)
    {
        $detalleVenta = $this->find($data['id']);
        if ($detalleVenta->delete()) {
            return true;
        }
        return false;
    }
    
    public function update($id, array $data)
    {
        $detalleVenta = $this->find($id);
        if ($detalleVenta->update($data)) {
            return true;
        }
        return false;
    }
}
