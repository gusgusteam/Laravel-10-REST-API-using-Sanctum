<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = $this->authRepository->login($credentials);
        if (!$user) {
            return ['user' => $user,'token' => null,'message' => 'credenciales incorrectas'];
        }
        $token = $user->createToken(config('app.name'))->plainTextToken;
        return ['user' => $user,'token' => $token,'message' => 'usuario existente'];
        
    }

    public function logout()
    {
        $this->authRepository->logout();
        return ['message' => 'session cerrada.'];
    }

    public function profile()
    {
        $user = $this->authRepository->getAuthenticatedUser();
        return $user;
    }

    public function updatePassword($data)
    {
        $user = $this->profile();
        return $this->authRepository->updatePassword(
            $user, 
            $data['current_password'], 
            $data['new_password']
        );
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = $this->authRepository->sendPasswordResetLink($request->email);

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent.'], 200);
        }

        return response()->json(['message' => 'Failed to send reset link.'], 400);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = $this->authRepository->resetPassword(
            $request->email,
            $request->token,
            $request->password
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to reset password.'], 400);
    }
    public function update($data)
    {
        return $this->authRepository->update($data);
    }
}
