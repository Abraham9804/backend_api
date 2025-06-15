<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessEntityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionNoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/users',[UserController::class, 'index']);
    Route::post('/users',[UserController::class, 'store']);
    Route::get('/users/{id}',[UserController::class, 'show']);
    Route::put('/users/{id}',[UserController::class, 'update']);
    Route::delete('/users/{id}',[UserController::class, 'funEliminar']);

    Route::apiResource('branch',BranchController::class);
    Route::apiResource('businessEntity',BusinessEntityController::class);
    Route::apiResource('category',CategoryController::class);
    Route::apiResource('contact',ContactController::class);
    Route::apiResource('permission',PermissionController::class);
    Route::apiResource('person',PersonController::class);
    Route::apiResource('product',ProductController::class);
    Route::apiResource('role',RoleController::class);
    Route::apiResource('transactionNote',TransactionNoteController::class);
    Route::apiResource('warehouse',WarehouseController::class);
});
