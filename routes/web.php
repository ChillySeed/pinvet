<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\KatalogController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\SuratController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PembayaranController;

/*
|--------------------------------------------------------------------------
| Guest Routes (Public)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{barang}', [KatalogController::class, 'show'])->name('katalog.show');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{barang}', [CartController::class, 'add'])->name('add');
    Route::patch('/update/{barang}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{barang}', [CartController::class, 'remove'])->name('remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

Route::get('/peminjaman/{peminjaman}/preview', [SuratController::class, 'preview'])->name('peminjaman.preview');
Route::post('/peminjaman/{peminjaman}/generate', [SuratController::class, 'generate'])->name('peminjaman.generate');

/*
|--------------------------------------------------------------------------
| Admin Routes (with middleware admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('barang', BarangController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('users', UserController::class);
    Route::resource('pengaturan', PengaturanController::class)->only(['index', 'update']);
    Route::resource('pembayaran', PembayaranController::class)->only(['index', 'show', 'update']);

    // Tambahan route untuk update status peminjaman
    Route::post('/peminjaman/{peminjaman}/update-status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
});

// Route login admin (nanti buat AuthController sederhana)
Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('admin.logout');