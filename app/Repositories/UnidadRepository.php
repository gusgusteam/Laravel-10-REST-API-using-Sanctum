<?php

namespace App\Repositories;

use App\Models\Unidad;

class UnidadRepository
{
    public function find($id)
    {
        return Unidad::findOrFail($id);
    }

    public function all()
    {
        return Unidad::all();
    }

    public function create(array $data)
    {
        return Unidad::create($data);
    }

    public function update($id, array $data)
    {
        $unidad = $this->find($id);
        $unidad->update($data);
        return $unidad;
    }

    public function destroy($id)
    {
        $unidad = $this->find($id);
        $unidad->update(['estado' => 0]); 
        return $unidad;
    }

    public function restore($id)
    {
        $unidad = $this->find($id);
        $unidad->update(['estado' => 1]); 
        return $unidad;
    }
}
