<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cabinet\HomeController as CabinetHomeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('register.verify');



Route::middleware(['auth'])->as('cabinet.')->group(function () {
    Route::get('/cabinet', [CabinetHomeController::class, 'index'])->name('home');
});
