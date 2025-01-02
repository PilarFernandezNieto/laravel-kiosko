<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Todas las rutas que se coloquen en este middleware, necesitaran un token de autenticación
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('/categorias', [CategoriaController::class, 'index']);
/** apiResource engloba todos los verbos que engloban las peticiones : GET, POST, PUT, DELETE */
Route::apiResource('categorias', CategoriaController::class);