<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cultivo\StoreCultivoRequest;
use App\Http\Requests\Cultivo\UpdateCultivoRequest;
use App\Http\Resources\CultivoResource;
use App\Services\CultivoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CultivoController extends Controller
{
    protected $cultivoService;

    public function __construct(CultivoService $cultivoService)
    {
        $this->cultivoService = $cultivoService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['nombre','estado']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $cultivos = $this->cultivoService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($cultivos, 200);
    }

    public function store(StoreCultivoRequest $request): JsonResponse
    {
        $cultivo = $this->cultivoService->create($request->validated());
        return response()->json(new CultivoResource($cultivo), 201);
    }

    public function show($id): JsonResponse
    {
        $cultivo = $this->cultivoService->find($id);
        return response()->json(new CultivoResource($cultivo), 200);
    }

    public function update(UpdateCultivoRequest $request, $id): JsonResponse
    {
        $cultivo = $this->cultivoService->update($id, $request->validated());
        return response()->json(new CultivoResource($cultivo), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->cultivoService->destroy($id);
        return response()->json(['message' => 'Cultivo inactivo.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $cultivo = $this->cultivoService->restore($id);
        return response()->json(new CultivoResource($cultivo), 200);
    }
}
