<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cabinet\ContactController;
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



Route::prefix('cabinet')->middleware(['auth'])->as('cabinet.')->group(function () {
    Route::get('/cabinet', [CabinetHomeController::class, 'index'])->name('home');

    Route::prefix('contacts')->middleware([\App\Http\Middleware\FilledProfile::class])->as('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/store', [ContactController::class, 'store'])->name('store');
        Route::get('/{contact}/show', [ContactController::class, 'show'])->name('show');
        Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::post('/{contact}/update', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}/destroy', [ContactController::class, 'destroy'])->name('destroy');
    });
});
