<?php

namespace App\Repositories;

use App\Models\DetalleCompra;

class DetalleCompraRepository
{
    public function getAll($id_NotaCompra)
    {
        return DetalleCompra::all();
    }

    public function find($id)
    {
        return DetalleCompra::findOrFail($id);
    }

    public function create(array $data)
    {
        $detalleCompra= new DetalleCompra($data);
        if (!$detalleCompra->save()) {
            return false;
        }
        return true;
    }

    public function aumentar_producto($id)
    {
        $detalleCompra = $this->find($id);
        $detalleCompra['cantidad'] += 1;
        if ($detalleCompra->update()) {
            return true;
        }
        return false;
    }
    public function restar_producto($id)
    {
        $detalleCompra = $this->find($id);
        $detalleCompra['cantidad'] -= 1;
        if ($detalleCompra->update()) {
            return true;
        }
        return false;
    }

    public function delete(array $data)
    {
        $detalleCompra = $this->find($data['id']);
        if ($detalleCompra->delete()) {
            return true;
        }
        return false;
    }
    
    public function update($id, array $data)
    {
        $detalleCompra = $this->find($id);
        if ($detalleCompra->update($data)) {
            return true;
        }
        return false;
    }
}
