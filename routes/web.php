<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\Admin\AdminMiddleware;

Route::get('/', [LoginController::class, 'getlogin'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');

// RUTA PÚBLICA - Moverla FUERA del middleware auth
Route::get('/certificado/{certificado_id}', [AdminController::class, 'documento'])->name('documento');

//todas las rutas que queremos proteger
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [AdminController::class, 'getdashboard'])->name('dashboard');
        Route::get('/add-evento', [AdminController::class, 'getAdd_Evento'])->name('add-evento');
        Route::post('/add-evento', [AdminController::class, 'postAdd_Evento']);
        Route::get('/add-certificado-base/{evento_id}', [AdminController::class, 'getAddCertificadoBase'])->name('add-certificado-base');
        Route::post('/add-certificado-base/{evento_id}', [AdminController::class, 'postAddCertificadoBase']);
        Route::get('/evento/{evento_id}', [AdminController::class, 'evento'])->name('evento');
        Route::get('/evento/{evento_id}/add-organizador', [AdminController::class, 'getAddOrganizador'])->name('add-organizador');
        Route::post('/evento/{evento_id}/add-organizador', [AdminController::class, 'postAddOrganizador']);
        Route::get('/evento/{evento_id}/add-ponente', [AdminController::class, 'getAddPonente'])->name('add-ponente');
        Route::post('/evento/{evento_id}/add-ponente', [AdminController::class, 'postAddPonente']);
        Route::get('/evento/{evento_id}/add-asistente', [AdminController::class, 'getAddAsistente'])->name('add-asistente');
        Route::post('/evento/{evento_id}/add-asistente', [AdminController::class, 'postAddAsistente']);
        Route::get('/evento/{evento_id}/certificados', [AdminController::class, 'certificados'])->name('admin-certificados');
        Route::get('/evento/{evento_id}/certificados/organizadores', [AdminController::class, 'generarCertificadoOrganizadores'])->name('generar-organizadores');
        Route::get('/evento/{evento_id}/certificados/ponentes', [AdminController::class, 'generarCertificadoPonentes'])->name('generar-ponentes');
        Route::get('/evento/{evento_id}/certificados/asistentes', [AdminController::class, 'generarCertificadoAsistentes'])->name('generar-asistentes');
        Route::get('/evento/{evento_id}/exportar-organizadores', [AdminController::class, 'exportarOrganizadores'])->name('exportar-organizadores');
    });
});