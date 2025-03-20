<?php

namespace App\Repositories;

use App\Models\Unidad;

class UnidadRepository
{
    public function AllPaginated(array $filters, int $perPage)
    {
        $query = Unidad::query();
        // Aplicar filtros si existen
        if (!empty($filters['nombre'])) {
            $query->where('nombre', 'like', '%' . $filters['nombre'] . '%');
        }
        if (!empty($filters['nombre_corto'])) {
            $query->where('nombre_corto','like', '%' .$filters['nombre_corto']. '%');
        }

        // Retornar los resultados paginados
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
