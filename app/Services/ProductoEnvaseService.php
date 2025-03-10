<?php

namespace App\Services;

use App\Repositories\ProductoEnvaseRepository;

class ProductoEnvaseService
{
    protected $productoEnvaseRepository;

    public function __construct(ProductoEnvaseRepository $productoEnvaseRepository)
    {
        $this->productoEnvaseRepository = $productoEnvaseRepository;
    }

    public function store(array $data)
    {
        return $this->productoEnvaseRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->productoEnvaseRepository->update($id, $data);
    }

    public function getAll()
    {
        return $this->productoEnvaseRepository->all();
    }

    public function find($id)
    {
        return $this->productoEnvaseRepository->find($id);
    }

    public function destroy($id)
    {
        return $this->productoEnvaseRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->productoEnvaseRepository->restore($id);
    }
}
