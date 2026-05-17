<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\JadwalKajianController;
use App\Http\Controllers\Admin\KelolaOrganisasi;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileOrganisasiController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\AmalUsahaController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/articles/all', [LandingController::class, 'showAllArticles'])->name('articles.show-all');
Route::get('/articles/{slug}', [LandingController::class, 'showArticle'])->name('articles.show');
Route::get('/struktur-organisasi', [LandingController::class, 'showStrukturOrganisasi'])->name('struktur-organisasi');
Route::get('/berita/show-all', [LandingController::class, 'showAllBerita'])->name('berita.all');
Route::get('/berita/detail/{berita}', [LandingController::class, 'showBerita'])->name('berita.show');
Route::get('/organisasi-otonom/{slug}', [LandingController::class, 'showOrganisasiOtonom'])->name('organisasi-otonom.show');
Route::get('/anggota-organisasi/{slug}', [LandingController::class, 'showAnggotaOrganisasi'])->name('anggota-organisasi.show');


Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/profile-organisasi', [ProfileOrganisasiController::class, 'index'])->name('admin.profile-organisasi');
        Route::get('/profile-organisasi/create', [ProfileOrganisasiController::class, 'create'])->name('admin.profile-organisasi.create');
        Route::post('/profile-organisasi', [ProfileOrganisasiController::class, 'store'])->name('admin.profile-organisasi.store');
        Route::delete('/profile-organisasi/{id}', [ProfileOrganisasiController::class, 'destroy'])->name('admin.profile-organisasi.destroy');
        Route::get('/profile-organisasi/{id}/edit', [ProfileOrganisasiController::class, 'edit'])->name('admin.profile-organisasi.edit');
        Route::put('/profile-organisasi/{id}', [ProfileOrganisasiController::class, 'update'])->name('admin.profile-organisasi.update');

        Route::get('/organisasi-otonom', [OrganisasiController::class, 'index'])->name('admin.organisasi-otonom');
        Route::get('/organisasi-otonom/create', [OrganisasiController::class, 'create'])->name('admin.organisasi-otonom.create');
        Route::post('/organisasi-otonom', [OrganisasiController::class, 'store'])->name('admin.organisasi-otonom.store');
        Route::get('/organisasi-otonom/{id}/edit', [OrganisasiController::class, 'edit'])->name('admin.organisasi-otonom.edit');
        Route::put('/organisasi-otonom/{id}', [OrganisasiController::class, 'update'])->name('admin.organisasi-otonom.update');
        Route::delete('/organisasi-otonom/{id}', [OrganisasiController::class, 'destroy'])->name('admin.organisasi-otonom.destroy');

        Route::get('/pengurus', [PengurusController::class, 'index'])->name('admin.pengurus.index');
        Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('admin.pengurus.create');
        Route::post('/pengurus', [PengurusController::class, 'store'])->name('admin.pengurus.store');
        Route::get('/pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('admin.pengurus.edit');
        Route::put('/pengurus/{id}', [PengurusController::class, 'update'])->name('admin.pengurus.update');
        Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('admin.pengurus.destroy');

        Route::resource('berita', NewsController::class);

        Route::get('/articles', [ArtikelController::class, 'index'])->name('admin.articles');
        Route::get('/articles/create', [ArtikelController::class, 'create'])->name('admin.articles.create');
        Route::post('/articles', [ArtikelController::class, 'store'])->name('admin.articles.store');
        Route::get('/articles/{id}/edit', [ArtikelController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/articles/{id}', [ArtikelController::class, 'update'])->name('admin.articles.update');
        Route::delete('/articles/{id}', [ArtikelController::class, 'destroy'])->name('admin.articles.destroy');

        Route::get('/program-kajian', [JadwalKajianController::class, 'index'])->name('admin.program-kajian');
        Route::get('/program-kajian/create', [JadwalKajianController::class, 'create'])->name('admin.jadwal-kajian.create');
        Route::post('/program-kajian', [JadwalKajianController::class, 'store'])->name('admin.jadwal-kajian.store');
        Route::get('/program-kajian/{id}/edit', [JadwalKajianController::class, 'edit'])->name('admin.jadwal-kajian.edit');
        Route::put('/program-kajian/{id}', [JadwalKajianController::class, 'update'])->name('admin.jadwal-kajian.update');
        Route::delete('/program-kajian/{id}', [JadwalKajianController::class, 'destroy'])->name('admin.jadwal-kajian.destroy');

        Route::get('/amal-usaha', [AmalUsahaController::class, 'index'])->name('admin.amal-usaha.index');
        Route::get('/amal-usaha/create', [AmalUsahaController::class, 'create'])->name('admin.amal-usaha.create');
        Route::post('/amal-usaha', [AmalUsahaController::class, 'store'])->name('admin.amal-usaha.store');
        Route::get('/amal-usaha/{id}/edit', [AmalUsahaController::class, 'edit'])->name('admin.amal-usaha.edit');
        Route::put('/amal-usaha/{id}', [AmalUsahaController::class, 'update'])->name('admin.amal-usaha.update');
        Route::delete('/amal-usaha/{id}', [AmalUsahaController::class, 'destroy'])->name('admin.amal-usaha.destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::middleware(['auth', 'role:superadmin'])->group(function () {

            Route::get('/manage-user', [ManageUserController::class, 'index'])
                ->name('admin.manage-user');

            Route::get('/manage-user/create', [ManageUserController::class, 'create'])
                ->name('admin.manage-user.create');

            Route::post('/manage-user', [ManageUserController::class, 'store'])
                ->name('admin.manage-user.store');

            Route::get('/manage-user/{id}/edit', [ManageUserController::class, 'edit'])
                ->name('admin.manage-user.edit');

            Route::put('/manage-user/{id}', [ManageUserController::class, 'update'])
                ->name('admin.manage-user.update');

            Route::delete('/manage-user/{id}', [ManageUserController::class, 'destroy'])
                ->name('admin.manage-user.destroy');
        });
    });
});

Route::prefix('penulis')->group(function () {
    Route::middleware(['auth', 'role:penulis'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('penulis.dashboard');

        Route::get('/articles', [ArtikelController::class, 'index'])->name('penulis.articles');
        Route::get('/articles/create', [ArtikelController::class, 'create'])->name('penulis.articles.create');
        Route::post('/articles', [ArtikelController::class, 'store'])->name('penulis.articles.store');
        Route::get('/articles/{id}/edit', [ArtikelController::class, 'edit'])->name('penulis.articles.edit');
        Route::put('/articles/{id}', [ArtikelController::class, 'update'])->name('penulis.articles.update');
        Route::delete('/articles/{id}', [ArtikelController::class, 'destroy'])->name('penulis.articles.destroy');

        Route::get('/berita', [NewsController::class, 'index'])->name('penulis.berita');
        Route::get('/berita/create', [NewsController::class, 'create'])->name('penulis.berita.create');
        Route::post('/berita', [NewsController::class, 'store'])->name('penulis.berita.store');
        Route::get('/berita/{id}/edit', [NewsController::class, 'edit'])->name('penulis.berita.edit');
        Route::put('/berita/{id}', [NewsController::class, 'update'])->name('penulis.berita.update');
        Route::delete('/berita/{id}', [NewsController::class, 'destroy'])->name('penulis.berita.destroy');
    });
});



Route::get('/cek-db', function () {
    return [
        'env' => env('DB_CONNECTION'),
        'config' => config('database.default'),
    ];
});

require __DIR__ . '/auth.php';
