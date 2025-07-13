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

    public function getAllPaginated($filters,$perPage,$sortField,$sortOrder)
    {
        return $this->clienteRepository->AllPaginated($filters,$perPage,$sortField,$sortOrder);
    }

    public function getAll()
    {
        return $this->clienteRepository->all();
    }

    public function find($id)
    {
        return $this->clienteRepository->find($id);
    }

    public function findbycodigo($codigo){
        return $this->clienteRepository->findByCodigo($codigo);
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

    public function EstadoCuentaGeneral($id_cliente,$id_gestion){
        $data = [
            'montoTotalContado' => $this->clienteRepository->EstadoCuentaNotasContado($id_cliente,$id_gestion),
            'montoTotalCredito' => $this->clienteRepository->EstadoCuentaNotasCredito($id_cliente,$id_gestion),
            'cantidad_venta_credito' => $this->clienteRepository->EstadoCuentaNotasCreditoCantidad($id_cliente,$id_gestion),
            'cantidad_venta_contado' => $this->clienteRepository->EstadoCuentaNotasContadoCantidad($id_cliente,$id_gestion),
            'cantidad_venta_anulada' => $this->clienteRepository->EstadoCuentaNotasAnuladoCantidad($id_cliente,$id_gestion),
            'cantidad_venta_pendiente' => $this->clienteRepository->EstadoCuentaNotasPendienteCantidad($id_cliente,$id_gestion),
        ];
        return $data;
    } 
    
    public function EstadoCuentaDevolucion($id_cliente,$id_gestion)
    {
        $data = [
            'montoTotalContado' => $this->clienteRepository->EstadoCuentaNotasContadoDevolucion($id_cliente,$id_gestion),
            'cantidad_devolucion_contado' => $this->clienteRepository->EstadoCuentaNotasContadoCantidadDevolucion($id_cliente,$id_gestion),
            'cantidad_devolucion_anulada' => $this->clienteRepository->EstadoCuentaNotasAnuladoCantidadDevolucion($id_cliente,$id_gestion),
            'cantidad_devolucion_pendiente' => $this->clienteRepository->EstadoCuentaNotasPendienteCantidadDevolucion($id_cliente,$id_gestion),
        ];
        return $data;
    }
    public function EstadoCuentaPDF($id_cliente,$id_gestion)
    {
        return $this->clienteRepository->PDF_ESTADO_CUENTA($id_cliente,$id_gestion);
    }

    public function EstadoCuentaPDFdevolucion($id_cliente,$id_gestion)
    {
        return $this->clienteRepository->PDF_ESTADO_CUENTA_DEVOLUCION($id_cliente,$id_gestion);
    }
}

