<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalBarang' => Barang::count(),
            'totalUsers' => User::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'pendingPeminjaman' => Peminjaman::where('status_peminjaman', 'pending')->count(),
            'barangTersedia' => Barang::sum('jumlah_tersedia'),
            'recentBarang' => Barang::latest()->take(5)->get(),
            'recentPeminjaman' => Peminjaman::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}