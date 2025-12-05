<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\LaporanController;

// Authentication Routes (from Laravel UI)
Auth::routes();

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Admin Routes Group
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Barang Resource
    Route::resource('/barang', BarangController::class);
    
    // Peminjaman Resource
    Route::resource('/peminjaman', PeminjamanController::class);
    
    // Custom Peminjaman Routes
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    
    // Pembayaran Resource
    Route::resource('/pembayaran', PembayaranController::class);
    
    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');
});

// Home Route (after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');