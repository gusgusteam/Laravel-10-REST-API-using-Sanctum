<?php

namespace App\Repositories;

use App\Models\Gestion;

class GestionRepository
{
    public function getAll()
    {
        return Gestion::all();
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
