<?php

namespace App\Repositories;

use App\Models\Envase;

class EnvaseRepository
{
    public function find($id)
    {
        return Envase::findOrFail($id);
    }

    public function all()
    {
        return Envase::all();
    }

    public function create(array $data)
    {
        return Envase::create($data);
    }

    public function update($id, array $data)
    {
        $envase = $this->find($id);
        $envase->update($data);
        return $envase;
    }

    public function destroy($id)
    {
        $envase = $this->find($id);
        $envase->update(['estado' => 0]); // Pone el estado a inactivo
        return $envase;
    }

    public function restore($id)
    {
        $envase = $this->find($id);
        $envase->update(['estado' => 1]); // Pone el estado a activo
        return $envase;
    }
}
