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
            return ['user' => $user,'token' => null,'messaje' => 'credenciales incorrectas'];
        }
        $token = $user->createToken(config('app.name'))->plainTextToken;
        return ['user' => $user,'token' => $token,'messaje' => 'usuario existente'];
        
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

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $this->authRepository->getAuthenticatedUser();
        $updated = $this->authRepository->updatePassword(
            $user, 
            $request->current_password, 
            $request->new_password
        );

        if (!$updated) {
            return response()->json(['message' => 'password es incorrecto.'], 400);
        }

        return response()->json(['message' => 'Password actualizado.'], 200);
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
}
