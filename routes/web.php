<?php

use App\Http\Controllers\Admin\ProfileOrganisasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/articles/{slug}', function ($slug) {
    return "Detail: " . $slug;
})->name('articles.show');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile-organisasi', [ProfileOrganisasiController::class, 'index'])->name('admin.profile-organisasi');
    Route::get('/profile-organisasi/create', [ProfileOrganisasiController::class, 'create'])->name('admin.profile-organisasi.create');
    Route::post('/profile-organisasi', [ProfileOrganisasiController::class, 'store'])->name('admin.profile-organisasi.store');
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

require __DIR__ . '/auth.php';
