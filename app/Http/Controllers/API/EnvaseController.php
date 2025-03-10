<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Envase\StoreEnvaseRequest;
use App\Http\Requests\Envase\UpdateEnvaseRequest;
use App\Http\Resources\EnvaseResource;
use App\Services\EnvaseService;
use Illuminate\Http\JsonResponse;

class EnvaseController extends Controller
{
    protected $envaseService;

    public function __construct(EnvaseService $envaseService)
    {
        $this->envaseService = $envaseService;
    }

    public function index(): JsonResponse
    {
        $envases = $this->envaseService->getAll();
        return response()->json(EnvaseResource::collection($envases), 200);
    }

    public function store(StoreEnvaseRequest $request): JsonResponse
    {
        $envase = $this->envaseService->create($request->validated());
        return response()->json(new EnvaseResource($envase), 201);
    }

    public function show($id): JsonResponse
    {
        $envase = $this->envaseService->find($id);

        if (!$envase) {
            return response()->json(['message' => 'Envase no encontrado.'], 404);
        }

        return response()->json(new EnvaseResource($envase), 200);
    }

    public function update(UpdateEnvaseRequest $request, $id): JsonResponse
    {
        $envase = $this->envaseService->find($id);

        if (!$envase) {
            return response()->json(['message' => 'Envase no encontrado.'], 404);
        }

        $envase = $this->envaseService->update($id, $request->validated());
        return response()->json(new EnvaseResource($envase), 200);
    }

    public function destroy($id): JsonResponse
    {
        $envase = $this->envaseService->find($id);

        if (!$envase) {
            return response()->json(['message' => 'Envase no encontrado.'], 404);
        }

        $this->envaseService->destroy($id);
        return response()->json(['message' => 'Envase eliminado correctamente.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $envase = $this->envaseService->find($id);

        if (!$envase) {
            return response()->json(['message' => 'Envase no encontrado.'], 404);
        }

        $envaseRestaurado = $this->envaseService->restore($id);
        return response()->json(new EnvaseResource($envaseRestaurado), 200);
    }
}
