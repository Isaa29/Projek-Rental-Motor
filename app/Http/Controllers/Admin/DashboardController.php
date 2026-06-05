<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;
use App\Models\Motor;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalJenis'      => JenisMotor::count(),
            'totalUnit'       => Motor::count(),
            'totalCustomer'   => User::where('role','customer')->count(),
            'totalTransaksi'  => Transaksi::count(),
            'totalPendapatan' => Transaksi::where('status','selesai')->sum('total_harga'),
            'unitTersedia'    => Motor::where('status','tersedia')->count(),
            'unitDisewa'      => Motor::where('status','disewa')->count(),
            'transaksiTerbaru'=> Transaksi::with(['user','jenisMotor'])->latest()->take(5)->get(),
        ]);
    }
}
