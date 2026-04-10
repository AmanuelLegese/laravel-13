<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::post('/validate-token', [AuthController::class, 'validateToken']);
Route::post('/revoke', [AuthController::class, 'revoke']);
Route::post('/register', [AuthController::class, 'register']);
