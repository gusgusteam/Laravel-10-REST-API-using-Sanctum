<?php

namespace App\Http\Controllers\API\administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(): JsonResponse
    {
        return response()->json(PermissionResource::collection($this->permissionService->getAll()), 200);
    }

    public function store(StorePermissionRequest $request): JsonResponse
    {
        return response()->json(new PermissionResource($this->permissionService->create($request->validated())), 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json(new PermissionResource($this->permissionService->findById($id)), 200);
    }

    public function update(UpdatePermissionRequest $request, $id): JsonResponse
    {
        return response()->json(new PermissionResource($this->permissionService->update($id, $request->validated())), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->permissionService->delete($id);
        return response()->json(['message' => 'Permiso eliminado correctamente'], 200);
    }
}
