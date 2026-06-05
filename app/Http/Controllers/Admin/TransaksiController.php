<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Motor;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['user','jenisMotor','motor']);
        if ($request->filled('status'))      $query->where('status',$request->status);
        if ($request->filled('status_bayar')) $query->where('status_bayar',$request->status_bayar);
        if ($request->filled('search')) {
            $k = $request->search;
            $query->whereHas('user', fn($q)=>$q->where('name','like',"%$k%"))
                  ->orWhereHas('jenisMotor', fn($q)=>$q->where('nama_jenis','like',"%$k%"));
        }
        return view('admin.transaksi', ['transaksis'=>$query->latest()->get()]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,aktif,selesai,dibatalkan'
        ]);

        $transaksi = Transaksi::with('motor')->findOrFail($id);

        // Kalau status jadi aktif
        if (
            $request->status === 'aktif' &&
            $transaksi->motor
        ) {

            $transaksi->motor->update([
                'status' => 'disewa'
            ]);
        }

        // Kalau status selesai / dibatalkan
        if (
            in_array($request->status, ['selesai', 'dibatalkan']) &&
            $transaksi->motor
        ) {

            $transaksi->motor->update([
                'status' => 'tersedia'
            ]);
        }

        // Validasi pembayaran sebelum selesai
        if (
            $request->status === 'selesai' &&
            $transaksi->status_bayar !== 'lunas'
        ) {

            return redirect()->back()->with(
                'error',
                'Status transaksi tidak bisa diubah ke selesai karena pembayaran belum lunas.'
            );
        }

        // Update status transaksi
        $transaksi->status = $request->status;

        // Kalau selesai otomatis lunas + buat laporan
        if ($request->status === 'selesai') {

            $transaksi->status_bayar = 'lunas';

            Laporan::updateOrCreate(
                ['transaksi_id' => $transaksi->id],
                [
                    'admin_id' => Auth::id(),
                    'keterangan' => 'Selesai pada ' . now()->format('d/m/Y H:i')
                ]
            );
        }

        $transaksi->save();

        return redirect()->back()->with(
            'success',
            'Status transaksi diperbarui.'
        );
    }

    public function verifikasiBayar(Request $request, $id)
    {
        $request->validate(['status_bayar' => 'required|in:menunggu,lunas,gagal']);

        Transaksi::findOrFail($id)->update(['status_bayar' => $request->status_bayar]);

        return redirect()->back()->with('success', 'Status pembayaran diperbarui.');
    }
}
