<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test/{edad}', function($edad){
    return [
        'nombre' => 'Abraham',
        'edad' => $edad
    ];
});

Route::post('/auth/login', [AuthController::class, "funLogin"]);
Route::post('/auth/register',[AuthController::class, 'funRegister']);
Route::get('/auth/profile',[AuthController::class, 'funPerfil']);
Route::post('/auth/logout', [AuthController::class, 'funLogout']);