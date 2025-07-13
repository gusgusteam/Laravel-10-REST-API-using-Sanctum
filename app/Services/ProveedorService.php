<?php

namespace App\Services;

use App\Repositories\ProveedorRepository;

class ProveedorService
{
    protected $ProveedorRepository;

    public function __construct(ProveedorRepository $ProveedorRepository)
    {
        $this->ProveedorRepository = $ProveedorRepository;
    }

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->ProveedorRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAll()
    {
        return $this->ProveedorRepository->all();
    }

    public function find($id)
    {
        return $this->ProveedorRepository->find($id);
    }

    public function findbycodigo($codigo){
        return $this->ProveedorRepository->findByCodigo($codigo);
    }

    public function create($data)
    {
        return $this->ProveedorRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->ProveedorRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->ProveedorRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->ProveedorRepository->restore($id);
    }

    public function EstadoCuentaGeneral($id_proveedor,$id_gestion){
        $data = [
            'montoTotalContado' => $this->ProveedorRepository->EstadoCuentaNotasContado($id_proveedor,$id_gestion),
            'montoTotalCredito' => $this->ProveedorRepository->EstadoCuentaNotasCredito($id_proveedor,$id_gestion),
            'cantidad_compra_credito' => $this->ProveedorRepository->EstadoCuentaNotasCreditoCantidad($id_proveedor,$id_gestion),
            'cantidad_compra_contado' => $this->ProveedorRepository->EstadoCuentaNotasContadoCantidad($id_proveedor,$id_gestion),
            'cantidad_compra_anulada' => $this->ProveedorRepository->EstadoCuentaNotasAnuladoCantidad($id_proveedor,$id_gestion),
            'cantidad_compra_pendiente' => $this->ProveedorRepository->EstadoCuentaNotasPendienteCantidad($id_proveedor,$id_gestion),
        ];
        return $data;
    } 
    
    public function EstadoCuentaDevolucion($id_proveedor,$id_gestion)
    {
        $data = [
            'montoTotalContado' => $this->ProveedorRepository->EstadoCuentaNotasContadoDevolucion($id_proveedor,$id_gestion),
            'cantidad_devolucion_contado' => $this->ProveedorRepository->EstadoCuentaNotasContadoCantidadDevolucion($id_proveedor,$id_gestion),
            'cantidad_devolucion_anulada' => $this->ProveedorRepository->EstadoCuentaNotasAnuladoCantidadDevolucion($id_proveedor,$id_gestion),
            'cantidad_devolucion_pendiente' => $this->ProveedorRepository->EstadoCuentaNotasPendienteCantidadDevolucion($id_proveedor,$id_gestion),
        ];
        return $data;
    }
    public function EstadoCuentaPDF($id_proveedor,$id_gestion)
    {
        return $this->ProveedorRepository->PDF_ESTADO_CUENTA($id_proveedor,$id_gestion);
    }

    public function EstadoCuentaPDFdevolucion($id_proveedor,$id_gestion)
    {
        return $this->ProveedorRepository->PDF_ESTADO_CUENTA_DEVOLUCION($id_proveedor,$id_gestion);
    }

}

