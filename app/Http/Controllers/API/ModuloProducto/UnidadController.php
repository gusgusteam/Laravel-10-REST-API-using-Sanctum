<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unidad\StoreUnidadRequest;
use App\Http\Requests\Unidad\UpdateUnidadRequest;
use App\Http\Resources\UnidadResource;
use App\Services\UnidadService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UnidadController extends Controller
{
    protected $unidadService;

    public function __construct(UnidadService $unidadService)
    {
        $this->unidadService = $unidadService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['nombre', 'nombre_corto']);
        $perPage = $request->input('per_page', 10);
        $unidades = $this->unidadService->getAllPaginated($filters, $perPage);
        //$unidades = $this->unidadService->getAll();
        // Retorna la respuesta en formato JSON
        return response()->json($unidades, 200);
        //return response()->json(UnidadResource::collection($unidades), 200);
    }

    public function store(StoreUnidadRequest $request): JsonResponse
    {
        $unidad = $this->unidadService->create($request->validated());
        return response()->json(new UnidadResource($unidad), 201);
    }

    public function show($id): JsonResponse
    {
        $unidad = $this->unidadService->find($id);
        return response()->json(new UnidadResource($unidad), 200);
    }

    public function update(UpdateUnidadRequest $request, $id): JsonResponse
    {
        $unidad = $this->unidadService->update($id, $request->validated());
        return response()->json(new UnidadResource($unidad), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->unidadService->destroy($id);
        return response()->json(['message' => 'Unidad inactiva.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $unidadRestaurada = $this->unidadService->restore($id);
        return response()->json(new UnidadResource($unidadRestaurada), 200);
    }
}
