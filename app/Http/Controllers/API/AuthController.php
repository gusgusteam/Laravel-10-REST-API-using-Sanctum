<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->sendError('Usuario no encontrado.', ['error' => 'Usuario incorrecto'], 200);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->sendError('Contraseña incorrecta.', ['error' => 'Contraseña incorrecta'], 200);
        }

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'Usuario autenticado correctamente.');
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return $this->sendResponse(null, 'autentificacion detenida');
        } else {
            return $this->sendError('No inicio sesion.', ['error' => 'no inicio sesion'], 200);
        }
    }

    public function profile(Request $request)
    {
        if ($request->user()) {
            $success['user'] = $request->user();
            return $this->sendResponse($success, 'usuario autentificado');
        } else {
            return $this->sendError('No está autenticado. Por favor, inicie sesión.', ['error' => 'paso el tiempo de espera'], 200);
        }
    }

    public function isAuthenticated()
    {
        if (auth()->check()) {
            $success['user']=true;
            return $this->sendResponse($success, 'Usuario autenticado.');
        } else {
            $success['user']=false;
            return $this->sendError($success, 'usuario no autentificado');
        }
    }
}
