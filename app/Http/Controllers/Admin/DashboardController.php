<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang' => Barang::count(),
            'total_peminjaman' => Peminjaman::count(),
            'peminjaman_pending' => Peminjaman::where('status_peminjaman', 'pending')->count(),
            'peminjaman_aktif' => Peminjaman::whereIn('status_peminjaman', ['disetujui', 'dipinjam'])->count(),
            'total_users' => User::count(),
        ];

        $recent_peminjaman = Peminjaman::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_peminjaman'));
    }
}