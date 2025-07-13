<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleVenta\DeleteDetalleVentaRequest;
use App\Http\Requests\DetalleVenta\StoreDetalleVentaRequest;
use App\Http\Requests\DetalleVenta\UpdateDetalleVentaRequest;
use App\Http\Resources\DetalleVentaResource;
use App\Services\DetalleVentaService;
use Illuminate\Http\JsonResponse;

class DetalleVentaController extends Controller
{
    protected $detalleVentaService;

    public function __construct(DetalleVentaService $detalleVentaService)
    {
        $this->detalleVentaService = $detalleVentaService;
    }

    public function add(StoreDetalleVentaRequest $request): JsonResponse
    {
        $detalle = $this->detalleVentaService->create($request->validated());
        return response()->json(['status'=> $detalle ,'message' => 'producto añadido.'], 201);
    }

    public function destroy(DeleteDetalleVentaRequest $request): JsonResponse
    {
        $detalle = $this->detalleVentaService->delete_detalle($request->validated());
        return response()->json(['status'=> $detalle ,'message' => 'Detalle de venta eliminado.'], 200);
    }

    public function add_aumentar($id): JsonResponse
    {
        $detalle = $this->detalleVentaService->add_aumentar($id);
        return response()->json(['status' => $detalle], 200);
    }

    public function add_restar($id): JsonResponse
    {
        $detalle = $this->detalleVentaService->add_restar($id);
        return response()->json(['status' => $detalle], 200);
    }

    public function update(UpdateDetalleVentaRequest $request,$id): JsonResponse
    {
        $detalle = $this->detalleVentaService->update($id, $request->validated());
        return response()->json(['status' => $detalle], 200);
    }
}
