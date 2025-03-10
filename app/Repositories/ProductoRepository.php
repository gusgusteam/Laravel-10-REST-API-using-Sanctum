<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductoRepository
{
    public function find($id)
    {
        return Producto::findOrFail($id)->load('categoria', 'tipoProducto');
    }

    public function all()
    {
        return Producto::all()->load('categoria', 'tipoProducto');
    }

    public function create(array $data)
    {
        return Producto::create($data);
    }

    public function update($id,array $data)
    {
        $producto = $this->find($id);
        $producto->update($data);
        $producto = $this->find($id);
        return $producto;
    }

    public function destroy($id)
    {
        $producto = $this->find($id);
        $producto->update(['estado' => 0]);
        return $producto;
    }

    public function restore($id)
    {
        $producto = $this->find($id);
        $producto->update(['estado' => 1]);
        return $producto;
    }
}