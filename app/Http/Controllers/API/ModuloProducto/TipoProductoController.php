<?php

namespace App\Http\Controllers\API\ModuloProducto;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProducto\StoreTipoProductoRequest;
use App\Http\Requests\TipoProducto\UpdateTipoProductoRequest;
use App\Http\Resources\TipoProductoResource;
use App\Services\TipoProductoService;
use Illuminate\Http\JsonResponse;

class TipoProductoController extends Controller
{
    protected $tipoProductoService;

    public function __construct(TipoProductoService $tipoProductoService)
    {
        $this->tipoProductoService = $tipoProductoService;
    }

    public function index(): JsonResponse
    {
        $tipos = $this->tipoProductoService->getAll();
        return response()->json(TipoProductoResource::collection($tipos), 200);
    }

    public function store(StoreTipoProductoRequest $request): JsonResponse
    {
        $tipoProducto = $this->tipoProductoService->create($request->validated());
        return response()->json(new TipoProductoResource($tipoProducto), 201);
    }

    public function show($id): JsonResponse
    {
        $tipoProducto = $this->tipoProductoService->find($id);
        return response()->json(new TipoProductoResource($tipoProducto), 200);
    }

    public function update(UpdateTipoProductoRequest $request, $id): JsonResponse
    {
        $tipoProducto = $this->tipoProductoService->update($id, $request->validated());
        return response()->json(new TipoProductoResource($tipoProducto), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->tipoProductoService->destroy($id);
        return response()->json(['message' => 'Tipo producto inactiva.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $tipoProductoRestaurado = $this->tipoProductoService->restore($id);
        return response()->json(new TipoProductoResource($tipoProductoRestaurado), 200);
    }
}
