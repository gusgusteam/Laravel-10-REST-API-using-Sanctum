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

    public function getAll()
    {
        return $this->detalleVentaRepository->getAll();
    }

    public function getById($id)
    {
        return $this->detalleVentaRepository->getById($id);
    }

    public function create($data)
    {
        //try {
            $data['subtotal'] = $data['precio_asignado'] * $data['cantidad'];
            return $this->detalleVentaRepository->create($data);
        //} catch (Exception $e) {
        //    throw new Exception("Error al crear el detalle de venta: " . $e->getMessage());
        //}
    }

    public function add_aumentar($id)
    {
        return $this->detalleVentaRepository->aumentar_producto($id);
    }

    public function add_restar($id)
    {
        return $this->detalleVentaRepository->restar_producto($id);
    }

    public function delete_detalle($id)
    {
        return $this->detalleVentaRepository->delete($id);
    }


    public function update($id, array $data)
    {
        try {
            return $this->detalleVentaRepository->update($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Detalle de venta no encontrado.");
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el detalle de venta: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->detalleVentaRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Detalle de venta no encontrado.");
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el detalle de venta: " . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            return $this->detalleVentaRepository->restore($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Detalle de venta no encontrado.");
        } catch (Exception $e) {
            throw new Exception("Error al restaurar el detalle de venta: " . $e->getMessage());
        }
    }
}
