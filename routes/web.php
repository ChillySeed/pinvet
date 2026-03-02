<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\KatalogController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\SuratController;
use App\Http\Controllers\Guest\PeminjamanController as GuestPeminjamanController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Guest Routes (Public)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog
Route::prefix('katalog')->name('guest.katalog.')->group(function () {
    Route::get('/', [KatalogController::class, 'index'])->name('index');
    Route::get('/{barang}', [KatalogController::class, 'show'])->name('show');
});

// Keranjang
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{barang}', [CartController::class, 'add'])->name('add');
    Route::patch('/update/{barang}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{barang}', [CartController::class, 'remove'])->name('remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

// Peminjaman (Guest flow)
Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
    Route::get('/start/{tipe}', [GuestPeminjamanController::class, 'start'])->name('start');
    Route::get('/form/{tipe}', [GuestPeminjamanController::class, 'form'])->name('form');
    Route::post('/store', [GuestPeminjamanController::class, 'store'])->name('store');
    Route::get('/{peminjaman}/preview', [SuratController::class, 'preview'])->name('preview');
    Route::post('/{peminjaman}/generate', [SuratController::class, 'generate'])->name('generate');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (with middleware admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('peminjaman', AdminPeminjamanController::class);
    Route::resource('users', UserController::class);

    // Pengaturan (tanpa parameter)
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // Pembayaran
    Route::resource('pembayaran', PembayaranController::class)->only(['index', 'create', 'show', 'edit', 'update']);

    // Update status peminjaman
    Route::post('/peminjaman/{peminjaman}/update-status', [AdminPeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
});

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');