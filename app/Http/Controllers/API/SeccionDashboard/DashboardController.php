<?php

namespace App\Http\Controllers\API\SeccionDashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    protected $DashboardService;

    public function __construct(DashboardService $DashboardService)
    {
        $this->DashboardService = $DashboardService;
    }

    public function EstadoGeneralDiario(): JsonResponse
    {
        $data = $this->DashboardService->EstadoGeneralDiario();
        return response()->json($data, 200);
    }

    public function EstadoGeneralRango($fechaInicio, $fechaFin): JsonResponse
    {
        $data = $this->DashboardService->EstadoGeneralRango($fechaInicio, $fechaFin);
        return response()->json($data, 200);
    }

    public function EstadoGeneralMensual(): JsonResponse
    {
        $data = $this->DashboardService->EstadoGeneralMesActual();
        return response()->json($data, 200);
    }

    public function EstadoGeneralDiarioCompra(): JsonResponse
    {
        $data = $this->DashboardService->EstadoGeneralDiarioCompra();
        return response()->json($data, 200);
    }

    public function EstadoGeneralRangoCompra($fechaInicio, $fechaFin): JsonResponse
    {
        $data = $this->DashboardService->EstadoGeneralRangoCompra($fechaInicio, $fechaFin);
        return response()->json($data, 200);
    }

    public function EstadoGeneralMensualCompra(): JsonResponse
    {
        $data = $this->DashboardService->EstadoGeneralMesActualCompra();
        return response()->json($data, 200);
    }
}
