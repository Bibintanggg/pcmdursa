<?php

use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\KelolaOrganisasi;
use App\Http\Controllers\Admin\ProfileOrganisasiController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/articles/all', [LandingController::class, 'showAllArticles'])->name('articles.show-all');
Route::get('/articles/{slug}', [LandingController::class, 'showArticle'])->name('articles.show');
Route::get('/struktur-organisasi', [LandingController::class, 'showStrukturOrganisasi'])->name('struktur-organisasi');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile-organisasi', [ProfileOrganisasiController::class, 'index'])->name('admin.profile-organisasi');
    Route::get('/profile-organisasi/create', [ProfileOrganisasiController::class, 'create'])->name('admin.profile-organisasi.create');
    Route::post('/profile-organisasi', [ProfileOrganisasiController::class, 'store'])->name('admin.profile-organisasi.store');
    Route::delete('/profile-organisasi/{id}', [ProfileOrganisasiController::class, 'destroy'])->name('admin.profile-organisasi.destroy');
    Route::get('/profile-organisasi/{id}/edit', [ProfileOrganisasiController::class, 'edit'])->name('admin.profile-organisasi.edit');
    Route::put('/profile-organisasi/{id}', [ProfileOrganisasiController::class, 'update'])->name('admin.profile-organisasi.update');

    Route::get('/struktur-organisasi',              [StrukturOrganisasiController::class, 'index'])->name('admin.struktur-organisasi');
    Route::post('/struktur-organisasi',             [StrukturOrganisasiController::class, 'store'])->name('admin.struktur-organisasi.store');
    Route::get('/struktur-organisasi/{strukturOrganisasi}/json', [StrukturOrganisasiController::class, 'show'])->name('admin.struktur-organisasi.show');
    Route::post('/struktur-organisasi/{strukturOrganisasi}',     [StrukturOrganisasiController::class, 'update'])->name('admin.struktur-organisasi.update');
    Route::delete('/struktur-organisasi/{strukturOrganisasi}', [StrukturOrganisasiController::class, 'destroy'])->name('admin.struktur-organisasi.destroy');

    Route::get('/articles', [ArtikelController::class, 'index'])->name('admin.articles');
    Route::get('/articles/create', [ArtikelController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [ArtikelController::class, 'store'])->name('admin.articles.store');
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
