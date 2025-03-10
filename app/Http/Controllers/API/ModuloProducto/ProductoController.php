<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;
use App\Services\ProductoService;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index(): JsonResponse
    {
        $productos = $this->productoService->getAll();
        return response()->json(ProductoResource::collection($productos), 200);
    }

    public function store(StoreProductoRequest $request): JsonResponse
    {
        $producto = $this->productoService->store($request->validated());
        return response()->json(new ProductoResource($producto), 201);
    }

    public function show($id): JsonResponse
    {
        $producto = $this->productoService->find($id);
        return response()->json(new ProductoResource($producto), 200);
    }

    public function update(UpdateProductoRequest $request, $id): JsonResponse
    {
        $producto = $this->productoService->update($id, $request->validated());
        return response()->json(new ProductoResource($producto), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->productoService->destroy($id);
        return response()->json(['message' => 'Producto inactiva.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $productoRestaurado = $this->productoService->restore($id);
        return response()->json(new ProductoResource($productoRestaurado), 200);
    }
}

