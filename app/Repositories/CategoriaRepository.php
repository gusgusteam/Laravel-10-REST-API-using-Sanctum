<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository
{
    public function find($id)
    {
        return Categoria::findOrFail($id);
    }

    public function all()
    {
        return Categoria::all();
    }

    public function create(array $data)
    {
        return Categoria::create($data);
    }

    public function update($id, array $data)
    {
        $categoria = $this->find($id);
        $categoria->update($data);
        return $categoria;
    }

    public function destroy($id)
    {
        $categoria = $this->find($id);
        $categoria->update(['estado' => 0]); 
        return $categoria;
    }

    public function restore($id)
    {
        $categoria = $this->find($id);
        $categoria->update(['estado' => 1]); 
        return $categoria;
    }
}
