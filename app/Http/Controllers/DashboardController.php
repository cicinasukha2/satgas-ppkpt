<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah user dan laporan
        $totalUser = User::count();
        $totalLaporan = Laporan::count();
        $laporan = Laporan::latest()->get();

        return view('dashboard.dashboard', compact('totalUser', 'totalLaporan', 'laporan'));
    }
}
