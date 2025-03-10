<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
{
    public function all()
    {
        return Cliente::all();
    }

    public function find($id)
    {
        return Cliente::findOrFail($id);
    }

    public function create(array $data)
    {
        return Cliente::create($data);
    }

    public function update($id, array $data)
    {
        $cliente = $this->find($id);
        $cliente->update($data);
        return $cliente;
    }

    public function destroy($id)
    {
        $cliente = $this->find($id);
        $cliente->update(['estado' => 0]);
        return $cliente;
    }

    public function restore($id)
    {
        $cliente = $this->find($id);
        $cliente->update(['estado' => 1]);
        return $cliente;
    }
}
