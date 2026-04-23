<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Credential\User;
use App\Http\Controllers\Task\Priority;
use App\Http\Controllers\Task\Status;
use App\Http\Controllers\Task\TaskActionController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/users', User::class);

    Route::apiResource('/status', Status::class);
    Route::apiResource('/priority', Priority::class);

    Route::apiResource('/tasks', TaskController::class);

    Route::post('/tasks/{task}/start', [TaskActionController::class, 'start']);
    Route::post('/tasks/{task}/complete', [TaskActionController::class, 'complete']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
