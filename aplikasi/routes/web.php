<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SliderController;

// Rute GET untuk root URL diarahkan ke dashboard admin
Route::get('/', function () {
    return redirect()->route('admin.dashboard.index');
});

// Rute POST untuk root URL jika diperlukan
Route::post('/', [DashboardController::class, 'handlePost'])->name('dashboard.handlePost');

// Rute lainnya
Route::get('/welcome', [HomeController::class, 'showWelcome'])->name('welcome');
Route::get('/berita/{id}', [HomeController::class, 'showBerita'])->name('berita');
Route::get('/beritas', [HomeController::class, 'showBeritas'])->name('beritas');
Route::get('/agenda', [HomeController::class, 'showAgenda'])->name('agenda');
// Definisikan rute dengan ID sebagai parameter
Route::get('/agendasingle/{id}', [HomeController::class, 'showAgendasingle'])->name('agendasingle');

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
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        
        // Permissions
        Route::resource('permissions', PermissionController::class)->except(['show', 'create', 'edit', 'update', 'destroy']);

        // Roles
        Route::resource('roles', RoleController::class, ['except' => ['show']]);

        // Users
        Route::resource('users', UserController::class, ['except' => ['show']]);

        // Tags
        Route::resource('tags', TagController::class, ['except' => ['show']]);

        // Categories
        Route::resource('categories', CategoryController::class, ['except' => ['show']]);

        // Post
        Route::resource('posts', PostController::class, ['except' => ['show']]);

        // Event
        Route::resource('events', EventController::class, ['except' => ['show']]);

        // Photo
        Route::resource('photos', PhotoController::class, ['except' => ['show']]);

         // Video
         Route::resource('videos', VideoController::class, ['except' => ['show']]);

          // Slider
          Route::resource('sliders', SliderController::class, ['except' => ['show']]);

          /*/ Frontend routes
Route::get('/foto', [PhotoController::class, 'indexview'])->name('foto');
*/



        
        

    });
