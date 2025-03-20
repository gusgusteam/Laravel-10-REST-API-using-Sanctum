<?php

namespace App\Services;

use App\Repositories\UnidadRepository;

class UnidadService
{
    protected $unidadRepository;

    public function __construct(UnidadRepository $unidadRepository)
    {
        $this->unidadRepository = $unidadRepository;
    }

    public function getAllPaginated($filters, $perPage)
    {
        return $this->unidadRepository->AllPaginated($filters, $perPage);
    }

    public function getAll()
    {
        return $this->unidadRepository->all();
    }

    public function find($id)
    {
        return $this->unidadRepository->find($id);
    }

    public function create($data)
    {
        return $this->unidadRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->unidadRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->unidadRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->unidadRepository->restore($id);
    }
}
