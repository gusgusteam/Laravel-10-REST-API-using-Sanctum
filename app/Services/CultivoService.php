<?php

namespace App\Services;

use App\Repositories\CultivoRepository;

class CultivoService
{
    protected $cultivoRepository;

    public function __construct(CultivoRepository $cultivoRepository)
    {
        $this->cultivoRepository = $cultivoRepository;
    }

    public function getAll()
    {
        return $this->cultivoRepository->getAll();
    }

    public function create($data)
    {
        return $this->cultivoRepository->create($data);
    }

    public function find($id)
    {
        return $this->cultivoRepository->find($id);
    }

    public function update($id, $data)
    {
        return $this->cultivoRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->cultivoRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->cultivoRepository->restore($id);
    }
}
