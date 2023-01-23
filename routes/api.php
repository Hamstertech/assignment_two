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
    Route::resource('/creator', CreatorController::class)->except(['index']);
    // Route::post('/creator', [CreatorController::class, 'update']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
});



/**
* Actions Handled By Resource Controller
* Verb	    URI	                    Action	        Route Name              View
* GET	        /photos	                index	        photos.index            index.blade.php
* GET	        /photos/create	        create	        photos.create           create.blade.php
* POST	        /photos	                store	        photos.store            (r)edirect to action: 'edit' or 'index' or 'create'
* GET	        /photos/{photo}	        show	        photos.show             show.blade.php
* GET	        /photos/{photo}/edit	edit	        photos.edit             edit.blade.php
* PUT/PATCH	    /photos/{photo}	        update	        photos.update           (r)edirect to action: 'edit' or 'index'
* DELETE	    /photos/{photo}	        destroy	        photos.destroy          (r)edirect to action: 'index'
*/