<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('task',[TaskController::class,'index']);
// Route::post('task',[TaskController::class,'store']);
// Route::put('task/{id}',[TaskController::class,'Update']);
// Route::get('task/{id}',[TaskController::class,'show']);
// Route::delete('task/{id}',[TaskController::class,'destroy']);

// Route::apiResource('task', TaskController::class);
