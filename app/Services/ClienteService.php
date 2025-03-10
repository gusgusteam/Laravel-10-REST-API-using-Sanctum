<?php

namespace App\Services;

use App\Repositories\ClienteRepository;

class ClienteService
{
    protected $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function getAll()
    {
        return $this->clienteRepository->all();
    }

    public function find($id)
    {
        return $this->clienteRepository->find($id);
    }

    public function create($data)
    {
        return $this->clienteRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->clienteRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->clienteRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->clienteRepository->restore($id);
    }
}

