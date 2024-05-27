<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

// Rute GET untuk halaman welcome
Route::get('/welcome', [HomeController::class, 'showWelcome'])->name('welcome');

// Rute lainnya
Route::get('/berita', [HomeController::class, 'showBerita'])->name('berita');
Route::get('/agenda', [HomeController::class, 'showAgenda'])->name('agenda');
Route::get('/agendasingle', [HomeController::class, 'showAgendasingle'])->name('agendasingle');
Route::get('/foto', [HomeController::class, 'showFoto'])->name('foto');
Route::get('/video', [HomeController::class, 'showVideo'])->name('video');
Route::get('/kontak', [HomeController::class, 'showKontak'])->name('kontak');

// Rute untuk otentikasi
Auth::routes();

// Rute untuk area admin
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');
    });

// Rute root diarahkan ke dashboard admin
Route::get('/', function () {
    return redirect()->route('admin.dashboard.index');
});

// Rute POST untuk root URL jika diperlukan
Route::post('/', [DashboardController::class, 'handlePost'])->name('dashboard.handlePost');
    
