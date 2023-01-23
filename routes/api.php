<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/')->name('front')->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('/creator/{id}', [CreatorController::class, 'show']);
    Route::post('/creator', [CreatorController::class, 'update']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
});