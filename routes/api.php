<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/**
 * Auth V1
 */
Route::post('login', [AuthController::class, 'login']);