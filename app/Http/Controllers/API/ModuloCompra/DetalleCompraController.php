<?php

namespace App\Http\Controllers\API\ModuloCompra;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleCompra\StoreDetalleCompraRequest;
use App\Http\Requests\DetalleCompra\UpdateDetalleCompraRequest;
use App\Http\Requests\DetalleCompra\DeleteDetalleCompraRequest;
use App\Http\Resources\DetalleCompraResource;
use App\Services\DetalleCompraService;
use Illuminate\Http\JsonResponse;

class DetalleCompraController extends Controller
{
    protected $DetalleCompraService;

    public function __construct(DetalleCompraService $DetalleCompraService)
    {
        $this->DetalleCompraService = $DetalleCompraService;
    }

    public function add(StoreDetalleCompraRequest $request): JsonResponse
    {
        $detalle = $this->DetalleCompraService->create($request->validated());
        return response()->json(['status'=> $detalle ,'message' => 'producto añadido.'], 201);
    }

    public function destroy(DeleteDetalleCompraRequest $request): JsonResponse
    {
        $detalle = $this->DetalleCompraService->delete_detalle($request->validated());
        return response()->json(['status'=> $detalle ,'message' => 'Detalle de venta eliminado.'], 200);
    }

    public function add_aumentar($id): JsonResponse
    {
        $detalle = $this->DetalleCompraService->add_aumentar($id);
        return response()->json(['status' => $detalle], 200);
    }

    public function add_restar($id): JsonResponse
    {
        $detalle = $this->DetalleCompraService->add_restar($id);
        return response()->json(['status' => $detalle], 200);
    }

    public function update(UpdateDetalleCompraRequest $request,$id): JsonResponse
    {
        $detalle = $this->DetalleCompraService->update($id, $request->validated());
        return response()->json(['status' => $detalle], 200);
    }
}
