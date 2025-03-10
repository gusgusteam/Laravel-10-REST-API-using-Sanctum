<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
         
        if ($exception instanceof \Illuminate\Database\QueryException) {
            return response()->json([
                'message' => 'Error de conexión a la base de datos'
            ], 500);
        } 
 
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
               'message' => 'Error de validación',
               'errors' => $exception->validator->errors(),
            ], 400);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        return parent::render($request, $exception);
    }

    //protected function unauthenticated($request, AuthenticationException $exception)
    //{
    //    return response()->json([
    //        'message' => 'Acceso denegado. Token inválido o sesión expirada.'
    //    ], 401);
    //}

}
