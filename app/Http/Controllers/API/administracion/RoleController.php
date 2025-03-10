<?php

namespace App\Http\Controllers\API\administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(): JsonResponse
    {
        return response()->json(RoleResource::collection($this->roleService->getAll()), 200);
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        return response()->json(new RoleResource($this->roleService->create($request->validated())), 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json(new RoleResource($this->roleService->find($id)), 200);
    }

    public function update(UpdateRoleRequest $request, $id): JsonResponse
    {
        return response()->json(new RoleResource($this->roleService->update($id, $request->validated())), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->roleService->delete($id);
        return response()->json(['message' => 'Rol eliminado correctamente'], 200);
    }
}
