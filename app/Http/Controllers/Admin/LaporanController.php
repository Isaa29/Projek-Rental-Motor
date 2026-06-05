<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['user','jenisMotor'])->where('status','selesai');
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal_sewa',$request->bulan)->whereYear('tanggal_sewa',$request->tahun);
        } elseif ($request->filled('tahun')) {
            $query->whereYear('tanggal_sewa',$request->tahun);
        } elseif ($request->filled('bulan')) {
            $query->whereMonth('tanggal_sewa',$request->bulan);
        }
        $transaksis      = $query->latest()->get();
        $totalPendapatan = $transaksis->sum('total_harga');
        $totalTransaksi  = $transaksis->count();
        return view('admin.laporan', compact('transaksis','totalPendapatan','totalTransaksi'));
    }
}
