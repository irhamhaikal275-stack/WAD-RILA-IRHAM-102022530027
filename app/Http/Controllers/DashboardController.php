<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        return view('dashboard.admin', [
            'totalPemesanan' => Pemesanan::count(),
            'totalPendapatan' => Pemesanan::sum('total_bayar'),
            'totalUser' => User::where('role', User::ROLE_USER)->count(),
            'totalRaket' => Pemesanan::sum('raket'),
            'totalSepatu' => Pemesanan::sum('sepatu'),
            'totalBola' => Pemesanan::sum('bola'),
            'terbaru' => Pemesanan::latest('id')->take(5)->get(),
        ]);
    }
}