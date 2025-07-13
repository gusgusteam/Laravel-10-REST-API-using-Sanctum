<?php

namespace App\Services;

use App\Repositories\CategoriaRepository;

class CategoriaService
{
    protected $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->categoriaRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAll()
    {
        return $this->categoriaRepository->all();
    }

    public function find($id)
    {
        return $this->categoriaRepository->find($id);
    }

    public function create($data)
    {
        return $this->categoriaRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->categoriaRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->categoriaRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->categoriaRepository->restore($id);
    }
}
