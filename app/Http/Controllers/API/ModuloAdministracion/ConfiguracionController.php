<?php

namespace App\Http\Controllers\API\ModuloAdministracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\UpdateConfiguracionRequest;
use App\Http\Resources\ConfiguracionResource;
use App\Services\ConfiguracionService;
use Illuminate\Http\JsonResponse;

class ConfiguracionController extends Controller
{
    protected $ConfiguracionService;

    public function __construct(ConfiguracionService $ConfiguracionService)
    {
        $this->ConfiguracionService = $ConfiguracionService;
    }

    public function show(): JsonResponse
    {
        $configuracion = $this->ConfiguracionService->find(1);
        return response()->json(new ConfiguracionResource($configuracion), 200);
    }

    public function update(UpdateConfiguracionRequest $request): JsonResponse
    {
        $configuracion = $this->ConfiguracionService->update(1, $request->validated());
        return response()->json(new ConfiguracionResource($configuracion), 200);
    }

    public function obtenerLogoBase64(): JsonResponse
    {
        return $this->ConfiguracionService->obtenerLogoBase64();
    }

}
