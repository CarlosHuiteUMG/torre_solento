<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('areas', AreaController::class);
        Route::get('reservations', [ReservationAdminController::class, 'index'])->name('reservations.index');
        Route::put('reservations/{reservation}', [ReservationAdminController::class, 'updateStatus'])->name('reservations.update-status');
    });
});

require __DIR__.'/auth.php';
