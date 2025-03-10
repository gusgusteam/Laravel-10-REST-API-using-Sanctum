<?php

namespace App\Services;

use App\Repositories\EnvaseRepository;

class EnvaseService
{
    protected $envaseRepository;

    public function __construct(EnvaseRepository $envaseRepository)
    {
        $this->envaseRepository = $envaseRepository;
    }

    public function getAll()
    {
        return $this->envaseRepository->all();
    }

    public function find($id)
    {
        return $this->envaseRepository->find($id);
    }

    public function create($data)
    {
        return $this->envaseRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->envaseRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->envaseRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->envaseRepository->restore($id);
    }
}

