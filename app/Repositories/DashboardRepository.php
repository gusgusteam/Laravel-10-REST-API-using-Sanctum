<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\NotaCompra;
use App\Models\NotaVenta;

class DashboardRepository
{
    public function MontoVenta($idGestion, $fechaInicio, $fechaFin)
    {
        return NotaVenta::where('nota_alterna', 0)
        ->where('gestion_id', $idGestion)
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->sum('monto_total');
    }

    public function cantidadNotas($idGestion, $fechaInicio, $fechaFin)
    {
        return NotaVenta::where('nota_alterna', 0)
        ->where('gestion_id', $idGestion)
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->count();
    }

    public function cantidadClientesVenta($idGestion, $fechaInicio, $fechaFin)
    {
        return NotaVenta::where('nota_alterna', 0)
        ->where('gestion_id', $idGestion)
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->distinct('cliente_id')
        ->count('cliente_id');
    }

    public function MontoCompra($idGestion, $fechaInicio, $fechaFin)
    {
        return NotaCompra::where('nota_alterna', 0)
        ->where('gestion_id', $idGestion)
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->sum('monto_total');
    }

    public function cantidadNotasCompra($idGestion, $fechaInicio, $fechaFin)
    {
        return NotaCompra::where('nota_alterna', 0)
        ->where('gestion_id', $idGestion)
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->count();
    }

    public function cantidadProveedores($idGestion, $fechaInicio, $fechaFin)
    {
        return NotaCompra::where('nota_alterna', 0)
        ->where('gestion_id', $idGestion)
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->distinct('proveedor_id')
        ->count('proveedor_id');
    }

  
}
