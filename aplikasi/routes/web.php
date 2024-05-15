<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'showWelcome'])->name('welcome');
Route::get('/berita', [HomeController::class, 'showBerita'])->name('berita');
Route::get('/agenda', [HomeController::class, 'showAgenda'])->name('agenda');
Route::get('/agendasingle', [HomeController::class, 'showAgendasingle'])->name('agendasingle');
Route::get('/foto', [HomeController::class, 'showFoto'])->name('foto');
Route::get('/video', [HomeController::class, 'showVideo'])->name('video');
Route::get('/kontak', [HomeController::class, 'showKontak'])->name('kontak');