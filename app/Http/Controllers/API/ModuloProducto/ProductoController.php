<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;
use App\Services\ProductoService;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['nombre','descripcion','categoria','tipoproducto']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $categorias = $this->productoService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($categorias, 200);
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

