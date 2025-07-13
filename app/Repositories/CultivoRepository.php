<?php

namespace App\Repositories;

use App\Models\Cultivo;

class CultivoRepository
{
    public function getAll()
    {
        return Cultivo::all();
    }

    public function AllPaginated(array $filters, int $perPage , string $sortField, string $sortOrder)
    {
        $query = Cultivo::query();
         // Filtrar por nombre
        if (!empty($filters['nombre'])) {
            $query->where('nombre', 'LIKE', '%' . $filters['nombre'] . '%');
        }
        if(!empty($filters['estado'])){
            $query->where('estado', '=',$filters['estado']);
        }
        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        return $query->paginate($perPage);
    }

    public function create(array $data)
    {
        return Cultivo::create($data);
    }

    public function find($id)
    {
        return Cultivo::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $cultivo = $this->find($id);
        $cultivo->update($data);
        return $cultivo;
    }

    public function destroy($id)
    {
        $cultivo = $this->find($id);
        $cultivo->update(['estado' => 0]);
        return $cultivo;
    }

    public function restore($id)
    {
        $cultivo = $this->find($id);
        $cultivo->update(['estado' => 1]);
        return $cultivo;
    }
}
