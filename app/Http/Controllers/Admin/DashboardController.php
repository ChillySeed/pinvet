<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPeminjamanAktif = Peminjaman::whereIn('status_peminjaman', ['ongoing', 'disetujui'])->count();
        $totalUser = User::count();
        $peminjamanPending = Peminjaman::where('status_peminjaman', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalPeminjamanAktif',
            'totalUser',
            'peminjamanPending'
        ));
    }
}