<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductoRepository
{
    public function AllPaginated(array $filters, int $perPage, string $sortField, string $sortOrder)
    {
        $query = Producto::with(['categoria', 'tipoProducto']); // Carga relaciones

        // Filtrar por nombre si se proporciona
        if (!empty($filters['nombre'])) {
            $query->where('nombre', 'LIKE', '%' . $filters['nombre'] . '%');
        }
        if (!empty($filters['descripcion'])) {
            $query->orWhere('descripcion', 'LIKE', '%' .$filters['descripcion']. '%');
        }
        if (!empty($filters['categoria'])) {
            $query->orwhereHas('categoria', function ($q) use ($filters) {
                $q->where('nombre', 'LIKE', '%' . $filters['categoria'] . '%');
            });
        }
        if (!empty($filters['tipoproducto'])) {
            $query->orwhereHas('tipoProducto', function ($q) use ($filters) {
                $q->where('nombre', 'LIKE', '%' . $filters['tipoproducto'] . '%');
            });
        }

        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        // Retornar con paginación
        return $query->paginate($perPage);
    }

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