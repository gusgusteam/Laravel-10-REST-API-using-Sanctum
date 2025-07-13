<?php

namespace App\Services;

use App\Repositories\GestionRepository;

class GestionService
{
    protected $gestionRepository;

    public function __construct(GestionRepository $gestionRepository)
    {
        $this->gestionRepository = $gestionRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->gestionRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAll()
    {
        return $this->gestionRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->gestionRepository->create($data);
    }

    public function find($id)
    {
        return $this->gestionRepository->find($id);
    }

    public function update($id,$data)
    {
        return $this->gestionRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->gestionRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->gestionRepository->restore($id);
    }

    public function actual($id)
    {
        return $this->gestionRepository->actual($id);
    }
}
