<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DueController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GalleryPhotoController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingSettingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;

// Landing page publik — bisa diakses tanpa login
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Auth bawaan laravel/ui (login, register, dst)
Auth::routes(['register' => false]); // registrasi anggota baru dilakukan admin, bukan self-register

// laravel/ui secara default redirect ke /home setelah login, dashboard sekarang di /dashboard
Route::redirect('/home', '/dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/gallery', [GalleryPhotoController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryPhotoController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{galleryPhoto}', [GalleryPhotoController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/gallery-settings', [LandingSettingController::class, 'edit'])->name('landing-settings.edit');
    Route::put('/gallery-settings', [LandingSettingController::class, 'update'])->name('landing-settings.update');

    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::resource('members', MemberController::class)->except(['show']);
    Route::get('/members/{member}/kartu', [MemberController::class, 'card'])->name('members.card');

    Route::resource('vehicles', VehicleController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('dues', DueController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('/export/anggota', [ExportController::class, 'members'])->name('export.members');
    Route::get('/export/iuran', [ExportController::class, 'dues'])->name('export.dues');

    Route::middleware(['admin_pusat'])->group(function () {
        Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah.index');
        Route::post('/wilayah', [WilayahController::class, 'store'])->name('wilayah.store');
        Route::delete('/wilayah/{wilayah}', [WilayahController::class, 'destroy'])->name('wilayah.destroy');
    });
});
