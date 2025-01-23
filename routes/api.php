<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Todas las rutas que se coloquen en este middleware, necesitaran un token de autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);


    /** apiResource engloba todos los verbos que engloban las peticiones : GET, POST, PUT, DELETE
     * VISITAR DOCUMENTACION LARAVEL PARA VER NOMBRES DE METODOS
    */

    // Almacenar pedidos
    Route::apiResource('/pedidos', PedidoController::class);
    // Muestra categorías y productos en la zona pública (usuarios autenticados)
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('productos', ProductoController::class);
});

// Listado de productos para el admin
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::get('/admin/productos', [ProductoController::class, 'indexAdmin']);
    Route::post('/admin/productos', [ProductoController::class, 'store']);
    Route::put('/admin/productos/{producto}', [ProductoController::class, 'update']);
    Route::delete('/admin/productos/{producto}', [ProductoController::class, 'destroy']);
});

// Autenticación
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
