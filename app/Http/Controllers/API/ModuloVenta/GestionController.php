<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gestion\StoreGestionRequest;
use App\Http\Requests\Gestion\UpdateGestionRequest;
use App\Http\Resources\GestionResource;
use App\Services\GestionService;
use Illuminate\Http\JsonResponse;

class GestionController extends Controller
{
    protected $gestionService;

    public function __construct(GestionService $gestionService)
    {
        $this->gestionService = $gestionService;
    }

    public function index(): JsonResponse
    {
        $gestiones = $this->gestionService->getAll();
        return response()->json(GestionResource::collection($gestiones), 200);
    }

    public function store(StoreGestionRequest $request): JsonResponse
    {
        $gestion = $this->gestionService->create($request->validated());
        return response()->json(new GestionResource($gestion), 201);
    }

    public function show($id): JsonResponse
    {
        $gestion = $this->gestionService->find($id);
        return response()->json(new GestionResource($gestion), 200);
    }

    public function update(UpdateGestionRequest $request, $id): JsonResponse
    {
        $gestion = $this->gestionService->update($id, $request->validated());
        return response()->json(new GestionResource($gestion), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->gestionService->destroy($id);
        return response()->json(['message' => 'Gestión inactiva.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $gestion = $this->gestionService->restore($id);
        return response()->json(new GestionResource($gestion), 200);
    }

    public function habilitar_gestion($id): JsonResponse
    {
        $gestion = $this->gestionService->actual($id);
        return response()->json(new GestionResource($gestion), 200);
    }
}
