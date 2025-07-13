<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoEnvase\StoreProductoEnvaseRequest;
use App\Http\Requests\ProductoEnvase\UpdateProductoEnvaseRequest;
use App\Http\Resources\ProductoEnvaseResource;
use App\Services\ProductoEnvaseService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductoEnvaseController extends Controller
{
    protected $productoEnvaseService;

    public function __construct(ProductoEnvaseService $productoEnvaseService)
    {
        $this->productoEnvaseService = $productoEnvaseService;
    }

    public function store_image(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ProductoEnvase', 'public');
            return response()->json(['url' => Storage::url($path)], 200);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['categoria','producto','NotaVenta_id','NotaDevolucion_id','NotaCompra_id','estado']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $productoEnvase = $this->productoEnvaseService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($productoEnvase, 200);
    }

    public function inventario(Request $request): JsonResponse
    {
        $filters = $request->only(['categoria','producto','NotaVenta_id','NotaDevolucion_id','NotaCompra_id','estado']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $productoEnvase = $this->productoEnvaseService->getInventario($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($productoEnvase, 200);
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
