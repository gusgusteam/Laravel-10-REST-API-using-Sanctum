<?php

namespace App\Services;

use App\Repositories\DetalleDevolucionRepository;


class DetalleDevolucionService
{
    protected $DetalleDevolucionRepository;

    public function __construct(DetalleDevolucionRepository $DetalleDevolucionRepository)
    {
        $this->DetalleDevolucionRepository = $DetalleDevolucionRepository;
    }

    public function getAll($id_NotaDevolucion)
    {
        return $this->DetalleDevolucionRepository->getAll($id_NotaDevolucion);
    }

    public function find($id)
    {
        return $this->DetalleDevolucionRepository->find($id);
    }

    public function create($data)
    {
        return $this->DetalleDevolucionRepository->create($data);
    }

    public function add_aumentar($id)
    {
        return $this->DetalleDevolucionRepository->aumentar_producto($id);
    }

    public function add_restar($id)
    {
        return $this->DetalleDevolucionRepository->restar_producto($id);
    }

    public function delete_detalle($data)
    {
        return $this->DetalleDevolucionRepository->delete($data);
    }

    public function update($id, $data)
    { 
        return $this->DetalleDevolucionRepository->update($id, $data);  
    }

}
