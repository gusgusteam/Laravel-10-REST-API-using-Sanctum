<?php

namespace App\Repositories;

use App\Models\Gestion;

class GestionRepository
{
    public function getAll()
    {
        return Gestion::all();
    }

    public function AllPaginated(array $filters, int $perPage , string $sortField, string $sortOrder)
    {
        $query = Gestion::query();
         // Filtrar por nombre
        if (!empty($filters['anio'])) {
            $query->where('anio', 'LIKE', '%' . $filters['anio'] . '%');
        }
        if (!empty($filters['nombre_campania'])) {
            $query->orWhere('nombre_campania', 'LIKE', '%' . $filters['nombre_campania'] . '%');
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
        return Gestion::create($data);
    }

    public function find($id)
    {
        return Gestion::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $gestion = $this->find($id);
        $gestion->update($data);
        return $gestion;
    }

    public function destroy($id)
    {
        $gestion = $this->find($id);
        $gestion->update(['estado' => 0]); 
        return $gestion;
    }

    public function restore($id)
    {
        $gestion = $this->find($id);
        $gestion->update(['estado' => 1]); 
        return $gestion;
    }

    public function actual($id)
    {
        Gestion::where('gestion_actual', 1)->update(['gestion_actual' => 0]);
        $gestion = $this->find($id);
        $gestion->update(['gestion_actual' => 1]);
        return $gestion;
    }
}
