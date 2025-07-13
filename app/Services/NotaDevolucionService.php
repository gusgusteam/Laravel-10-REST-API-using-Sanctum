<?php

namespace App\Services;

use App\Repositories\NotaDevolucionRepository;


class NotaDevolucionService
{
    protected $NotaDevolucionRepository;

    public function __construct(NotaDevolucionRepository $NotaDevolucionRepository)
    {
        $this->NotaDevolucionRepository = $NotaDevolucionRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->NotaDevolucionRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAllDetallesNotaDevolucion($id_NotaDevolucion)
    {
        return $this->NotaDevolucionRepository->detallesNotaDevolucion($id_NotaDevolucion);
    }

    public function getAll()
    {
        return $this->NotaDevolucionRepository->all();
    }

    public function find($id)
    {
        return $this->NotaDevolucionRepository->find($id);
    }

    public function create($data)
    {
        return $this->NotaDevolucionRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->NotaDevolucionRepository->update($id, $data);
    }

    public function firma_completar($id)
    {
        return $this->NotaDevolucionRepository->completar_firma($id);
    }

    public function anular($data)
    {
        return $this->NotaDevolucionRepository->anular_nota($data);
    }
}