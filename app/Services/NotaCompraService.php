<?php

namespace App\Services;

use App\Repositories\NotaCompraRepository;

class NotaCompraService
{
    protected $NotaCompraRepository;

    public function __construct(NotaCompraRepository $NotaCompraRepository)
    {
        $this->NotaCompraRepository = $NotaCompraRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->NotaCompraRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAllDetallesNotaVenta($id_NotaVenta)
    {
        return $this->NotaCompraRepository->detallesNotaCompra($id_NotaVenta);
    }

    public function getAll()
    {
        return $this->NotaCompraRepository->all();
    }

    public function find($id)
    {
        return $this->NotaCompraRepository->find($id);
    }

    public function create($data)
    {
        return $this->NotaCompraRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->NotaCompraRepository->update($id, $data);
    }

    public function firma_completar($id)
    {
        return $this->NotaCompraRepository->completar_firma($id);
    }

    public function anular($data)
    {
        return $this->NotaCompraRepository->anular_nota($data);
    }
}