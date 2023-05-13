<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rotas protegidas
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('users', UserController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('activity_types', ActivityTypeController::class);

    Route::get('activities/filter', [ActivityController::class, 'filterByDate']);

    // Rota de logout
    Route::post('logout', [AuthController::class, 'logout']);
});

// Rotas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);