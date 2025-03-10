<?php

namespace App\Services;

use App\Repositories\ProductoRepository;

class ProductoService
{
    protected $productoRepository;

    public function __construct(ProductoRepository $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    public function getAll()
    {
        return $this->productoRepository->all();
    }

    public function store($data)
    {
        return $this->productoRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->productoRepository->update($id, $data);
    }

    public function find($id)
    {
        return $this->productoRepository->find($id);
    }

    public function destroy($id)
    {
        return $this->productoRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->productoRepository->restore($id);
    }
}
