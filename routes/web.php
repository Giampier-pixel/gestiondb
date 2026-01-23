<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\Admin\AdminMiddleware;
Route::get('/', [LoginController::class, 'getlogin'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');
//todas las rutas que queremos proteger
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [AdminController::class, 'getdashboard'])->name('dashboard');
        Route::get('/evento/{evento_id}', [AdminController::class, 'evento'])->name('evento');
    });
});
