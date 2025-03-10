<?php


use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ModuloAuth\AuthController;

use App\Http\Controllers\API\UsuarioController;
//use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\ModuloProducto\CategoriaController;
use App\Http\Controllers\API\ModuloProducto\UnidadController;
use App\Http\Controllers\API\EnvaseController;
use App\Http\Controllers\API\ModuloProducto\TipoProductoController;
use App\Http\Controllers\API\ModuloProducto\ProductoController;
use App\Http\Controllers\API\ModuloProducto\ProductoEnvaseController;

use App\Http\Controllers\API\administracion\RoleController;
use App\Http\Controllers\API\administracion\PermissionController;

use App\Http\Controllers\API\administracion\AdminController;
use App\Http\Controllers\API\administracion\UserController;
use App\Http\Controllers\API\ModuloVenta\ClienteController;
use App\Http\Controllers\API\ModuloVenta\CultivoController;
use App\Http\Controllers\API\ModuloVenta\GestionController;
use App\Http\Controllers\API\ModuloVenta\NotaVentaController;

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function (){
    Route::post('users/store','store');
    //Route::post('users/update/{id}','update');
    Route::get('users/index','index');
    Route::get('users/show/{id}','show');
    Route::get('users/destroy/{id}','destroy');
    Route::get('users/restore/{id}','restore');  
});

Route::middleware('auth:sanctum')->controller(AdminController::class)->group(function (){
    Route::post('admin/roles/{id_rol}/assign-permission','assignPermission');
    Route::post('admin/roles/{id_rol}/remove-permission','removePermission');
    Route::post('admin/users/{id_user}/assign-role','assignRole');
    Route::post('admin/users/{id_user}/remove-role','removeRole');
    Route::get('admin/roles/users','usersByRole');
});

Route::middleware('auth:sanctum')->controller(RoleController::class)->group(function (){
    Route::post('roles/store','store');
    Route::post('roles/update/{id}','update');
    Route::get('roles/index','index');
});

Route::middleware('auth:sanctum')->controller(PermissionController::class)->group(function (){
    Route::post('permissions/store','store');
    //Route::post('permissions/update/{id}','update');
    Route::get('permissions/index','index');
});



Route::middleware('auth:sanctum')->controller(UnidadController::class)->group(function (){
    Route::post('unidades/store','store');
    Route::post('unidades/update/{id}','update');
    Route::get('unidades/index','index');
    Route::get('unidades/show/{id}','show');
    Route::get('unidades/destroy/{id}','destroy');
    Route::get('unidades/restore/{id}','restore');  
});

Route::middleware('auth:sanctum')->controller(CategoriaController::class)->group(function (){
    Route::post('categoria/store','store');
    Route::post('categoria/update/{id}','update');
    Route::get('categoria/index','index');
    Route::get('categoria/show/{id}','show');
    Route::get('categoria/destroy/{id}','destroy');
    Route::get('categoria/restore/{id}','restore');  
});

Route::middleware('auth:sanctum')->controller(TipoProductoController::class)->group(function (){
    Route::post('tipo_producto/store','store');
    Route::post('tipo_producto/update/{id}','update');
    Route::get('tipo_producto/index','index');
    Route::get('tipo_producto/show/{id}','show');
    Route::get('tipo_producto/destroy/{id}','destroy');
    Route::get('tipo_producto/restore/{id}','restore');  
});



Route::middleware('auth:sanctum')->controller(ProductoController::class)->group(function (){
    Route::post('producto/store','store');
    Route::post('producto/update/{id}','update');
    Route::get('producto/index','index');
    Route::get('producto/show/{id}','show');
    Route::get('producto/destroy/{id}','destroy');
    Route::get('producto/restore/{id}','restore');  
});



Route::middleware('auth:sanctum')->controller(ProductoEnvaseController::class)->group(function () {
    Route::post('producto_envase/store', 'store');
    Route::post('producto_envase/update/{id}', 'update');
    Route::get('producto_envase/index', 'index');
    Route::get('producto_envase/show/{id}', 'show');
    Route::get('producto_envase/destroy/{id}', 'destroy');
    Route::get('producto_envase/restore/{id}', 'restore');
});

Route::middleware('auth:sanctum')->controller(GestionController::class)->group(function (){
    Route::post('gestion/store','store');
    Route::post('gestion/update/{id}','update');
    Route::get('gestion/index','index');
    Route::get('gestion/show/{id}','show');
    Route::get('gestion/destroy/{id}','destroy');
    Route::get('gestion/restore/{id}','restore'); 
    Route::get('gestion/gestion_actual/{id}','habilitar_gestion');
});

Route::middleware('auth:sanctum')->controller(CultivoController::class)->group(function (){
    Route::post('cultivo/store','store');
    Route::post('cultivo/update/{id}','update');
    Route::get('cultivo/index','index');
    Route::get('cultivo/show/{id}','show');
    Route::get('cultivo/destroy/{id}','destroy');
    Route::get('cultivo/restore/{id}','restore');  
});

Route::middleware('auth:sanctum')->controller(ClienteController::class)->group(function (){
    Route::post('cliente/store','store');
    Route::post('cliente/update/{id}','update');
    Route::get('cliente/index','index');
    Route::get('cliente/show/{id}','show');
    Route::get('cliente/destroy/{id}','destroy');
    Route::get('cliente/restore/{id}','restore');  
});

Route::middleware('auth:sanctum')->controller(NotaVentaController::class)->group(function (){
    Route::post('nota_venta/store','store');
    Route::post('nota_venta/update/{id}','update');
    Route::get('nota_venta/index','index');
    Route::get('nota_venta/show/{id}','show');
    Route::get('nota_venta/destroy/{id}','destroy');
    Route::get('nota_venta/restore/{id}','restore');  
});


//Modulo Auth

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::put('update-password', [AuthController::class, 'updatePassword'])->middleware('auth:sanctum');

//////////




//Route::prefix('envases')->group(function () {
//    Route::get('/', [EnvaseController::class, 'index']);
//    Route::post('/store', [EnvaseController::class, 'store']);
//    Route::get('/{id}', [EnvaseController::class, 'show']);
//    Route::put('/{id}', [EnvaseController::class, 'update']);
//    Route::delete('/{id}', [EnvaseController::class, 'destroy']);
//    Route::patch('/restore/{id}', [EnvaseController::class, 'restore']);
//});
//
//Route::prefix('tipos-producto')->group(function () {
//    Route::get('/', [TipoProductoController::class, 'index']);
//    Route::post('/', [TipoProductoController::class, 'store']);
//    Route::get('/{id}', [TipoProductoController::class, 'show']);
//    Route::put('/{id}', [TipoProductoController::class, 'update']);
//    Route::delete('/{id}', [TipoProductoController::class, 'destroy']);
//    Route::patch('/restore/{id}', [TipoProductoController::class, 'restore']);
//});

//Route::middleware('auth:sanctum')->controller(UsuarioController::class)->group(function (){
//    // Route::get('usuario/show/{id}','show')->name('usuario.show');
//    // Route::get('usuario/destroy/{id}','destroy')->name('usuario.destroy');
//    // Route::get('usuario/restart/{id}','restart')->name('usuario.destroy');
//     Route::get('usuario/index','index')->name('usuario.index');
//     // metodos con request
//     Route::post('usuario/store','store')->name('usuario.store');
//   //  Route::post('usuario/update/{id}','update')->name('usuario.update');
//     
//});



//Route::apiResource('tipoproductos', TipoProductoController::class)->except(['show']);
//Route::patch('tipoproductos/{tipoproducto}/restore', [TipoProductoController::class, 'restore']);

//Route::apiResource('unidades', UnidadController::class)->except(['show']);
//Route::patch('unidades/{id}/restore', [UnidadController::class, 'restore']);
//
//Route::apiResource('categorias', CategoriaController::class)->except(['show']);
//Route::patch('categorias/{id}/restore', [CategoriaController::class, 'restore']);



//Route::post('/login', [AuthController::class, 'login']);
//Route::middleware('auth:sanctum')->get('/auth', [AuthController::class, 'isAuthenticated']);
//Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
//Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'profile']);



