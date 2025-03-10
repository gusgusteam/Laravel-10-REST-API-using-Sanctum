<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoEnvase\StoreProductoEnvaseRequest;
use App\Http\Requests\ProductoEnvase\UpdateProductoEnvaseRequest;
use App\Http\Resources\ProductoEnvaseResource;
use App\Services\ProductoEnvaseService;
use Illuminate\Http\JsonResponse;

class ProductoEnvaseController extends Controller
{
    protected $productoEnvaseService;

    public function __construct(ProductoEnvaseService $productoEnvaseService)
    {
        $this->productoEnvaseService = $productoEnvaseService;
    }

    public function index(): JsonResponse
    {
        $productoEnvases = $this->productoEnvaseService->getAll();
        return response()->json(ProductoEnvaseResource::collection($productoEnvases), 200);
    }

    public function store(StoreProductoEnvaseRequest $request): JsonResponse
    {
        $productoEnvase = $this->productoEnvaseService->store($request->validated());
        return response()->json(new ProductoEnvaseResource($productoEnvase), 201);
    }

    public function show($id): JsonResponse
    {
        $productoEnvase = $this->productoEnvaseService->find($id);
        return response()->json(new ProductoEnvaseResource($productoEnvase), 200);
    }

    public function update(UpdateProductoEnvaseRequest $request, $id): JsonResponse
    {
        $productoEnvase = $this->productoEnvaseService->update($id, $request->validated());
        return response()->json(new ProductoEnvaseResource($productoEnvase), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->productoEnvaseService->destroy($id);
        return response()->json(['message' => 'Producto Envase inactivo.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $productoEnvase = $this->productoEnvaseService->restore($id);
        return response()->json(new ProductoEnvaseResource($productoEnvase), 200);
    }
}
