<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RiceTypeController;
use App\Http\Controllers\Admin\ZakatTypeController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('rice-types', RiceTypeController::class);
    Route::resource('zakat-types', ZakatTypeController::class);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('zakat', App\Http\Controllers\User\ZakatPaymentController::class);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('infaq', \App\Http\Controllers\User\InfaqController::class);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('penerima-zakat', \App\Http\Controllers\User\PenerimaZakatController::class);
});

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::resource('zakat-types', App\Http\Controllers\Admin\ZakatTypeController::class);
// });

require __DIR__ . '/auth.php';
