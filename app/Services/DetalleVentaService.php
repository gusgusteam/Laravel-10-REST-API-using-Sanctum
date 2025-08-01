<?php

namespace App\Services;

use App\Repositories\DetalleVentaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class DetalleVentaService
{
    protected $detalleVentaRepository;

    public function __construct(DetalleVentaRepository $detalleVentaRepository)
    {
        $this->detalleVentaRepository = $detalleVentaRepository;
    }

    public function getAll($id_NotaVenta)
    {
        return $this->detalleVentaRepository->getAll($id_NotaVenta);
    }

    public function find($id)
    {
        return $this->detalleVentaRepository->find($id);
    }

    public function create($data)
    {
        //$data['subtotal'] = $data['cantidad'] * $data['precio_asignado'];
        return $this->detalleVentaRepository->create($data);
    }

    public function add_aumentar($id)
    {
        return $this->detalleVentaRepository->aumentar_producto($id);
    }

    public function add_restar($id)
    {
        return $this->detalleVentaRepository->restar_producto($id);
    }

    public function delete_detalle($data)
    {
        return $this->detalleVentaRepository->delete($data);
    }

    public function update($id, $data)
    { 
        return $this->detalleVentaRepository->update($id, $data);  
    }

}
