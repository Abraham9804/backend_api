<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/auth')->group(function(){
    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/register',[AuthController::class, 'funRegister']);

    Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile',[AuthController::class, 'funPerfil'])->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class, 'funLogout']);
    });
});

Route::get('/users',[UsuarioController::class, 'funListar']);
Route::post('/users',[UsuarioController::class, 'funGuardar']);
Route::get('/users/{id}',[UsuarioController::class, 'funMostrar']);
Route::put('/users/{id}',[UsuarioController::class, 'funModificar']);
Route::delete('/users/{id}',[UsuarioController::class, 'funEliminar']);