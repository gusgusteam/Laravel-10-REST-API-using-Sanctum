<?php

namespace App\Http\Controllers\API\ModuloAdministracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAll();
        return response()->json(UserResource::collection($users), 200);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->create2($request->validated());
        return response()->json(new UserResource($user), 201);
    }

    public function show($id): JsonResponse
    {
        $user = $this->userService->find($id);
        return response()->json(new UserResource($user), 200);
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = $this->userService->update($id, $request->validated());
        return response()->json(new UserResource($user), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->userService->destroy($id);
        return response()->json(['message' => 'Usuario eliminado correctamente.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $userRestaurado = $this->userService->restore($id);
        return response()->json(new UserResource($userRestaurado), 200);
    }
}
