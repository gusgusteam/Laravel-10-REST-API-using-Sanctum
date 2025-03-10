<?php

namespace App\Repositories;

use App\Models\NotaVenta;

class NotaVentaRepository
{
    public function all()
    {
        return NotaVenta::with(['cliente', 'user', 'gestion', 'cultivo'])->get();
    }

    public function find($id)
    {
        return NotaVenta::with(['cliente', 'user', 'gestion', 'cultivo'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return NotaVenta::create($data);
    }

    public function update($id, array $data)
    {
        $notaVenta = $this->find($id);
        $notaVenta->update($data);
        return $notaVenta;
    }

    public function destroy($id)
    {
        $notaVenta = $this->find($id);
        $notaVenta->update(['estado' => 0]);
        return $notaVenta;
    }

    public function restore($id)
    {
        $notaVenta = $this->find($id);
        $notaVenta->update(['estado' => 1]);
        return $notaVenta;
    }
}