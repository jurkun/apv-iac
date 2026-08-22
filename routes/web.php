<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DueController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Auth bawaan laravel/ui (login, register, dst)
Auth::routes(['register' => false]); // registrasi anggota baru dilakukan admin, bukan self-register
Route::redirect('/home', '/');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::resource('members', MemberController::class)->except(['show']);
    Route::resource('vehicles', VehicleController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('dues', DueController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('/export/anggota', [ExportController::class, 'members'])->name('export.members');
    Route::get('/export/iuran', [ExportController::class, 'dues'])->name('export.dues');
});
