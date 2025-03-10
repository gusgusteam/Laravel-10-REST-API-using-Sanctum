<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StorageUserRequest;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\UserService;

class UsuarioController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        try {
            $datos = User::all();
            $success= $datos;
            return $this->sendResponse($success, 'Datos obtenidos.');
        } catch (\Throwable $th) {
            return $this->sendError('No hay datos.', ['error' => 'conexion lenta']);
        }
    }

    public function store(StorageUserRequest $request)
    {
        try {
            $datosForm = $request->only(['name', 'email', 'ci','paterno', 'materno', 'direccion', 'fechaNacimiento', 'edad']);
            $registro = $this->userService->create($datosForm);

            if (!$registro) {
                return $this->sendResponse('Solicitud no ejecutada', ['error' => 'conexion lenta'], 200);
            }
            return $this->sendResponse($registro, 'Registro creado.');
            
        }  catch (\Throwable $th) {
            return $this->sendError('Servidor no disponible.', ['error' => 'Servidor no disponible'], 201);
        }
    }
 
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            // Verificar si el usuario existe
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'El registro no existe.'
                ], 200); // Código de estado HTTP para "No encontrado"
            }

            if ($user->estado == 0) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'El registro ya se encuentra inactivo.'
                ], 404); // Código de estado HTTP para "No encontrado"
            }

            $user->estado = 0;
            $user->update();
            return response()->json([
                'success' => true,
                'data' => $user->estado,
                'mensaje' => 'Registro inhabilitado.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'mensaje' => 'Servidor no disponible'], 500);
        }
    }

    public function restart($id)
    {
        try {
            $user = User::find($id);
            // Verificar si el usuario existe
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'El registro no existe.'
                ], 404); // Código de estado HTTP para "No encontrado"
            }

            if ($user->estado == 1) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'El registro ya se encuentra activo.'
                ], 404); // Código de estado HTTP para "No encontrado"
            }

            $user->estado = 1;
            $user->update();
            return response()->json([
                'success' => true,
                'data' => $user,
                'mensaje' => 'Registro habilitado.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'mensaje' => 'Servidor no disponible'], 500);
        }
    }
}
