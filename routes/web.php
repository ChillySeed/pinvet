<?php

use App\Http\Controllers\Guest\MainController;
use App\Http\Controllers\Guest\KatalogController;
use App\Http\Controllers\Guest\PeminjamanController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest Routes (Public)
Route::get('/', [MainController::class, 'index'])->name('guest.home');

// Katalog Routes
Route::prefix('katalog')->group(function () {
    Route::get('/', [KatalogController::class, 'index'])->name('guest.katalog.index');
    Route::get('/{id}', [KatalogController::class, 'show'])->name('guest.katalog.show');
    Route::get('/kategori/{kategori}', [KatalogController::class, 'byKategori'])->name('guest.katalog.kategori');
});

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('guest.cart.index');
    Route::post('/add/{barang}', [CartController::class, 'add'])->name('guest.cart.add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('guest.cart.remove');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('guest.cart.update');
});

// Peminjaman Routes
Route::prefix('peminjaman')->group(function () {
    Route::get('/start/{tipe}', [PeminjamanController::class, 'start'])->name('peminjaman.start');
    Route::post('/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/tracking', [PeminjamanController::class, 'tracking'])->name('peminjaman.tracking');
    Route::get('/status/{kode}', [PeminjamanController::class, 'status'])->name('peminjaman.status');
});

// Auth Routes
Auth::routes(['register' => false]);

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/barang', BarangController::class);
});

// Default redirect setelah login
Route::get('/redirect-after-login', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('guest.home');
    }
    return redirect('/');
})->name('redirect.after.login');