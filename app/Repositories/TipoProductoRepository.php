<?php

namespace App\Repositories;

use App\Models\TipoProducto;

class TipoProductoRepository
{
    public function find($id)
    {
        return TipoProducto::findOrFail($id);
    }

    public function all()
    {
        return TipoProducto::all();
    }

    public function create(array $data)
    {
        return TipoProducto::create($data);
    }

    public function update($id, array $data)
    {
        $tipoProducto = $this->find($id);
        $tipoProducto->update($data);
        return $tipoProducto;
    }

    public function destroy($id)
    {
        $tipoProducto = $this->find($id);
        $tipoProducto->update(['estado' => 0]);
        return $tipoProducto;
    }

    public function restore($id)
    {
        $tipoProducto = $this->find($id);
        $tipoProducto->update(['estado' => 1]);
        return $tipoProducto;
    }
}
