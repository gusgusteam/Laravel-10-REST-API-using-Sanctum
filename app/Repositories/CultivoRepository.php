<?php

namespace App\Repositories;

use App\Models\Cultivo;

class CultivoRepository
{
    public function getAll()
    {
        return Cultivo::all();
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
