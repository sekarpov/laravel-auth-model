<?php

use App\Http\Controllers\Api\User\ContactController;
use App\Http\Controllers\Api\User\ProfileController;
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

Route::middleware('auth:api')->group(function() {
    Route::get('/user', [ProfileController::class, 'show']);
    Route::prefix('contacts')->group(function() {
        Route::get('/', [ContactController::class, 'index']);
        Route::post('/store', [ContactController::class, 'store']);
        Route::get('/{contact}/show', [ContactController::class, 'show']);
        Route::post('/{contact}/update', [ContactController::class, 'update']);
        Route::delete('/{contact}/destroy', [ContactController::class, 'destroy']);
    });
});
