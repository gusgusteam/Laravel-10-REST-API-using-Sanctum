<?php

namespace App\Repositories;

use App\Models\ProductoEnvase;

class ProductoEnvaseRepository
{
    public function create(array $data)
    {
        return ProductoEnvase::create($data);
    }

    public function update($id, array $data)
    {
        $productoEnvase = $this->find($id);
        $productoEnvase->update($data);
        return $productoEnvase;
    }

    public function all()
    {
        return ProductoEnvase::with(['producto', 'unidad'])->get();
    }

    public function find($id)
    {
        //return ProductoEnvase::findOrFail($id)->load('producto', 'unidad');
        return ProductoEnvase::with(['producto', 'unidad'])->findOrFail($id);
    }

    public function destroy($id)
    {
        $productoEnvase = $this->find($id);
        $productoEnvase->update(['estado' => 0]);
        return $productoEnvase;
    }

    public function restore($id)
    {
        $productoEnvase = $this->find($id);
        $productoEnvase->update(['estado' => 1]);
        return $productoEnvase;
    }
}
