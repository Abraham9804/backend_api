<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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


Route::get('/users',[UserController::class, 'index']);
Route::post('/users',[UserController::class, 'store']);
Route::get('/users/{id}',[UserController::class, 'show']);
Route::put('/users/{id}',[UserController::class, 'update']);
Route::delete('/users/{id}',[UserController::class, 'funEliminar']);

Route::apiResource('/role',[RoleController::class]);