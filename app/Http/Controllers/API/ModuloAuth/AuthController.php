<?php

namespace App\Http\Controllers\API\ModuloAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdateRequest;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->authService->login($request);
        return response()->json($response, 200);
    }

    public function logout(): JsonResponse
    {
        $response = $this->authService->logout();
        return response()->json($response, 200);
    }

    public function profile(): JsonResponse
    {
        $response = $this->authService->profile();
        return response()->json(new UserResource($response), 200);
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $response = $this->authService->updatePassword($request->validated());
        return response()->json($response, 200);
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $response = $this->authService->forgotPassword($request);
        return response()->json($response, 200);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $response = $this->authService->resetPassword($request);
        return response()->json($response, 200);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $response = $this->authService->update($request->validated());
        return response()->json($response, 200);
    }
}
