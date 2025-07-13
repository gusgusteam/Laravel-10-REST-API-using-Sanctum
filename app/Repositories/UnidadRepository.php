<?php

namespace App\Repositories;

use App\Models\Unidad;

class UnidadRepository
{
    public function AllPaginated(array $filters, int $perPage , string $sortField, string $sortOrder)
    {
        $query = Unidad::query();
         // Filtrar por nombre
        if (!empty($filters['nombre'])) {
            $query->where('nombre', 'LIKE', '%' . $filters['nombre'] . '%');
        }
        // Filtrar por nombre corto
        if (!empty($filters['nombre_corto'])) {
            $query->orWhere('nombre_corto', 'LIKE', '%' .$filters['nombre_corto']. '%');
        }
        if(!empty($filters['estado'])){
            $query->where('estado', '=',$filters['estado']);
        }
        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        return $query->paginate($perPage);
    }
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
