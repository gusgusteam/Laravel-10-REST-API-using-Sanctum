<?php

namespace App\Http\Controllers\API\ModuloDevolucion;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleDevolucion\StoreDetalleDevolucionRequest;
use App\Http\Requests\DetalleDevolucion\UpdateDetalleDevolucionRequest;
use App\Http\Requests\DetalleDevolucion\DeleteDetalleDevolucionRequest;
use App\Http\Resources\DetalleDevolucionResource;
use App\Services\DetalleDevolucionService;
use Illuminate\Http\JsonResponse;

class DetalleDevolucionController extends Controller
{
    protected $DetalleDevolucionService;

    public function __construct(DetalleDevolucionService $DetalleDevolucionService)
    {
        $this->DetalleDevolucionService = $DetalleDevolucionService;
    }

    public function add(StoreDetalleDevolucionRequest $request): JsonResponse
    {
        $detalle = $this->DetalleDevolucionService->create($request->validated());
        return response()->json(['status'=> $detalle ,'message' => 'producto añadido.'], 201);
    }

    public function destroy(UpdateDetalleDevolucionRequest $request): JsonResponse
    {
        $detalle = $this->DetalleDevolucionService->delete_detalle($request->validated());
        return response()->json(['status'=> $detalle ,'message' => 'Detalle de devolucion eliminado.'], 200);
    }

    public function add_aumentar($id): JsonResponse
    {
        $detalle = $this->DetalleDevolucionService->add_aumentar($id);
        return response()->json(['status' => $detalle], 200);
    }

    public function add_restar($id): JsonResponse
    {
        $detalle = $this->DetalleDevolucionService->add_restar($id);
        return response()->json(['status' => $detalle], 200);
    }

    public function update(DeleteDetalleDevolucionRequest $request,$id): JsonResponse
    {
        $detalle = $this->DetalleDevolucionService->update($id, $request->validated());
        return response()->json(['status' => $detalle], 200);
    }
}
