<?php

namespace App\Repositories;

use App\Models\DetalleVenta;

class DetalleVentaRepository
{
    public function getAll()
    {
        return DetalleVenta::with(['notaVenta', 'productoEnvase'])->get();
    }

    public function getById($id)
    {
        return DetalleVenta::with(['notaVenta', 'productoEnvase'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return DetalleVenta::create($data);
    }

    public function aumentar_producto($id)
    {
        $detalleVenta = $this->getById($id);
        $detalleVenta['cantidad'] += 1;
        $detalleVenta->update();
        return $detalleVenta['cantidad'];
    }
    public function restar_producto($id)
    {
        $detalleVenta = $this->getById($id);
        $detalleVenta['cantidad'] -= 1;
        $detalleVenta->update();
        return $detalleVenta['cantidad'];
    }

    public function delete($id)
    {
        $detalleVenta = $this->getById($id);
        $detalleVenta->delete();
        return true;
    }
    
    public function update($id, array $data)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        $detalleVenta->update($data);
        return $detalleVenta;
    }

    //public function delete($id)
    //{
    //    $detalleVenta = DetalleVenta::findOrFail($id);
    //    $detalleVenta->update(['estado' => 0]); // Inactivar en lugar de eliminar
    //}

    public function restore($id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        $detalleVenta->update(['estado' => 1]); // Restaurar a activo
    }
}
