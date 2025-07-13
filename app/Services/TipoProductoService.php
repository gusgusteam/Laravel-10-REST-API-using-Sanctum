<?php

namespace App\Services;

use App\Repositories\TipoProductoRepository;

class TipoProductoService
{
    protected $tipoProductoRepository;

    public function __construct(TipoProductoRepository $tipoProductoRepository)
    {
        $this->tipoProductoRepository = $tipoProductoRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->tipoProductoRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAll()
    {
        return $this->tipoProductoRepository->all();
    }

    public function find($id)
    {
        return $this->tipoProductoRepository->find($id);
    }

    public function create($data)
    {
        return $this->tipoProductoRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->tipoProductoRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->tipoProductoRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->tipoProductoRepository->restore($id);
    }
}
