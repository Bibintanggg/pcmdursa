<?php

use App\Http\Controllers\Admin\ProfileOrganisasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
})->name('admin.dashboard');

    Route::get('/profile-organisasi', [ProfileOrganisasiController::class, 'index'])->name('admin.profile-organisasi');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cek-db', function () {
    return [
        'env' => env('DB_CONNECTION'),
        'config' => config('database.default'),
    ];
});

require __DIR__.'/auth.php';
