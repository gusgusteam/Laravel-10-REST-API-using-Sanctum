<?php

namespace App\Services;

use App\Repositories\NotaVentaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class NotaVentaService
{
    protected $notaVentaRepository;

    public function __construct(NotaVentaRepository $notaVentaRepository)
    {
        $this->notaVentaRepository = $notaVentaRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->notaVentaRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAllDetallesNotaVenta($id_NotaVenta)
    {
        return $this->notaVentaRepository->detallesNotaVenta($id_NotaVenta);
    }

    public function getAll()
    {
        return $this->notaVentaRepository->all();
    }

    public function find($id)
    {
        return $this->notaVentaRepository->find($id);
    }

    public function create($data)
    {
        return $this->notaVentaRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->notaVentaRepository->update($id, $data);
    }

    public function firma_completar($id)
    {
        return $this->notaVentaRepository->completar_firma($id);
    }

    public function anular($data)
    {
        return $this->notaVentaRepository->anular_nota($data);
    }
}