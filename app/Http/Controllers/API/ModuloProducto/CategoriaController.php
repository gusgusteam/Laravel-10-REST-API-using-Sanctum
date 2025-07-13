<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Services\CategoriaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function index(Request $request): JsonResponse
    {
       // $categorias = $this->categoriaService->getAllPaginated();
        $filters = $request->only(['nombre','estado']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $categorias = $this->categoriaService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($categorias, 200);
    }

    public function store(StoreCategoriaRequest $request): JsonResponse
    {
        $categoria = $this->categoriaService->create($request->validated());
        return response()->json(new CategoriaResource($categoria), 201);
    }

    public function show($id): JsonResponse
    {
        $categoria = $this->categoriaService->find($id);
        return response()->json(new CategoriaResource($categoria), 200);
    }

    public function update(UpdateCategoriaRequest $request, $id): JsonResponse
    {
        $categoria = $this->categoriaService->update($id, $request->validated());
        return response()->json(new CategoriaResource($categoria), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->categoriaService->destroy($id);
        return response()->json(['message' => 'Categoría inactiva.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $categoriaRestaurada = $this->categoriaService->restore($id);
        return response()->json(new CategoriaResource($categoriaRestaurada), 200);
    }
}
