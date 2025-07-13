<?php

namespace App\Services;

use App\Models\Gestion;
use App\Repositories\DashboardRepository;
use Carbon\Carbon;

class DashboardService
{
    protected $DashboardRepository;

    public function __construct(DashboardRepository $DashboardRepository)
    {
        $this->DashboardRepository = $DashboardRepository;
    }

    public function MontoVenta($fechaInicio = null, $fechaFin = null){
        $fechaInicio = $fechaInicio ?? Carbon::today()->toDateString();
        $fechaFin = $fechaFin ?? Carbon::today()->toDateString();
        $gestion = Gestion::where('gestion_actual', 1)->first();
        if (!$gestion) {
            return 0; // No hay gestión activa, retornar 0
        }
        
        return $this->DashboardRepository->MontoVenta($gestion->id, $fechaInicio, $fechaFin);
    }

    public function CantidadVenta($fechaInicio = null, $fechaFin = null){
        $fechaInicio = $fechaInicio ?? Carbon::today()->toDateString();
        $fechaFin = $fechaFin ?? Carbon::today()->toDateString();
        $gestion = Gestion::where('gestion_actual', 1)->first();
        if (!$gestion) {
            return 0; // No hay gestión activa, retornar 0
        }

        return $this->DashboardRepository->cantidadNotas($gestion->id, $fechaInicio, $fechaFin);
    }

    public function CantidadClienteVenta($fechaInicio = null, $fechaFin = null){
        $fechaInicio = $fechaInicio ?? Carbon::today()->toDateString();
        $fechaFin = $fechaFin ?? Carbon::today()->toDateString();
        $gestion = Gestion::where('gestion_actual', 1)->first();
        if (!$gestion) {
            return 0; // No hay gestión activa, retornar 0
        }

        return $this->DashboardRepository->cantidadClientesVenta($gestion->id, $fechaInicio, $fechaFin);
    }

    public function EstadoGeneralDiario(){
        $data = [
            'monto_venta' => $this->MontoVenta(),
            'cantidad_venta' => $this->CantidadVenta(),
            'cantidad_cliente' => $this->CantidadClienteVenta()
        ];
        return  $data;
    }

    public function EstadoGeneralRango($fechaInicio, $fechaFin){
        $data = [
            'monto_venta' => $this->MontoVenta($fechaInicio, $fechaFin),
            'cantidad_venta' => $this->CantidadVenta($fechaInicio, $fechaFin),
            'cantidad_cliente' => $this->CantidadClienteVenta($fechaInicio, $fechaFin)
        ];
        return  $data;
    }

    public function EstadoGeneralMesActual()
    {
        $fechaInicio = Carbon::now()->startOfMonth()->toDateString();
        $fechaFin = Carbon::now()->endOfMonth()->toDateString();
    
        $data = [
            'monto_venta' => $this->MontoVenta($fechaInicio, $fechaFin),
            'cantidad_venta' => $this->CantidadVenta($fechaInicio, $fechaFin),
            'cantidad_cliente' => $this->CantidadClienteVenta($fechaInicio, $fechaFin)
        ];
    
        return $data;
    }

    // compra

    public function MontoCompra($fechaInicio = null, $fechaFin = null){
        $fechaInicio = $fechaInicio ?? Carbon::today()->toDateString();
        $fechaFin = $fechaFin ?? Carbon::today()->toDateString();
        $gestion = Gestion::where('gestion_actual', 1)->first();
        if (!$gestion) {
            return 0; // No hay gestión activa, retornar 0
        }
        
        return $this->DashboardRepository->MontoCompra($gestion->id, $fechaInicio, $fechaFin);
    }

    public function CantidadCompra($fechaInicio = null, $fechaFin = null){
        $fechaInicio = $fechaInicio ?? Carbon::today()->toDateString();
        $fechaFin = $fechaFin ?? Carbon::today()->toDateString();
        $gestion = Gestion::where('gestion_actual', 1)->first();
        if (!$gestion) {
            return 0; // No hay gestión activa, retornar 0
        }

        return $this->DashboardRepository->cantidadNotasCompra($gestion->id, $fechaInicio, $fechaFin);
    }

    public function CantidadProveedores($fechaInicio = null, $fechaFin = null){
        $fechaInicio = $fechaInicio ?? Carbon::today()->toDateString();
        $fechaFin = $fechaFin ?? Carbon::today()->toDateString();
        $gestion = Gestion::where('gestion_actual', 1)->first();
        if (!$gestion) {
            return 0; // No hay gestión activa, retornar 0
        }

        return $this->DashboardRepository->cantidadProveedores($gestion->id, $fechaInicio, $fechaFin);
    }

    public function EstadoGeneralDiarioCompra(){
        $data = [
            'monto_compra' => $this->MontoCompra(),
            'cantidad_compra' => $this->CantidadCompra(),
            'cantidad_proveedor' => $this->CantidadProveedores()
        ];
        return  $data;
    }

    public function EstadoGeneralRangoCompra($fechaInicio, $fechaFin){
        $data = [
            'monto_compra' => $this->MontoCompra($fechaInicio, $fechaFin),
            'cantidad_compra' => $this->CantidadCompra($fechaInicio, $fechaFin),
            'cantidad_proveedor' => $this->CantidadProveedores($fechaInicio, $fechaFin)
        ];
        return  $data;
    }

    public function EstadoGeneralMesActualCompra()
    {
        $fechaInicio = Carbon::now()->startOfMonth()->toDateString();
        $fechaFin = Carbon::now()->endOfMonth()->toDateString();
    
        $data = [
            'monto_compra' => $this->MontoCompra($fechaInicio, $fechaFin),
            'cantidad_compra' => $this->CantidadCompra($fechaInicio, $fechaFin),
            'cantidad_proveedor' => $this->CantidadProveedores($fechaInicio, $fechaFin)
        ];
    
        return $data;
    }

}
