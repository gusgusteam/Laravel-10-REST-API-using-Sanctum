<?php

namespace App\Services;

use App\Repositories\DetalleCompraRepository;

class DetalleCompraService
{
    protected $DetalleCompraRepository;

    public function __construct(DetalleCompraRepository $DetalleCompraRepository)
    {
        $this->DetalleCompraRepository = $DetalleCompraRepository;
    }

    public function getAll($id_NotaVenta)
    {
        return $this->DetalleCompraRepository->getAll($id_NotaVenta);
    }

    public function find($id)
    {
        return $this->DetalleCompraRepository->find($id);
    }

    public function create($data)
    {
        return $this->DetalleCompraRepository->create($data);
    }

    public function add_aumentar($id)
    {
        return $this->DetalleCompraRepository->aumentar_producto($id);
    }

    public function add_restar($id)
    {
        return $this->DetalleCompraRepository->restar_producto($id);
    }

    public function delete_detalle($data)
    {
        return $this->DetalleCompraRepository->delete($data);
    }

    public function update($id, $data)
    { 
        return $this->DetalleCompraRepository->update($id, $data);  
    }

}
