<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class HomeController extends Controller
{
    public function index()
    {
        $barangTerbaru = Barang::latest()->take(8)->get();
        return view('guest.home', compact('barangTerbaru'));
    }
}