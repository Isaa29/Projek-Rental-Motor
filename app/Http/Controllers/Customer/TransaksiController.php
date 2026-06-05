<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;
use App\Models\Transaksi;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function create($jenis_id)
    {
        $jenis = JenisMotor::withCount([
            'motors as tersedia_count' => fn($q)=>$q->where('status','tersedia'),
        ])->findOrFail($jenis_id);

        if ($jenis->tersedia_count === 0) {
            return redirect()->route('customer.rental.index')
                ->with('error','Maaf, semua unit '.$jenis->nama_jenis.' sedang tidak tersedia.');
        }

        return view('customer.sewa', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_motor_id'  => 'required|exists:jenis_motors,id',
            'tanggal_sewa'    => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'metode_bayar'    => 'required|in:transfer_mandiri,transfer_bri,tunai',
            'bukti_bayar'     => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ], [
            'tanggal_sewa.after_or_equal' => 'Tanggal sewa tidak boleh sebelum hari ini.',
            'tanggal_kembali.after'        => 'Tanggal kembali harus setelah tanggal sewa.',
            'bukti_bayar.image'            => 'Bukti bayar harus berupa gambar.',
            'bukti_bayar.max'              => 'Ukuran file maksimal 3MB.',
        ]);

        $jenis = JenisMotor::findOrFail($request->jenis_motor_id);

        $motor = Motor::where('jenis_motor_id', $jenis->id)
            ->where('status', 'tersedia')
            ->first();

        if (!$motor) {
            return back()
                ->with('error', 'Unit motor tidak tersedia.')
                ->withInput();
        }
        $durasi = Carbon::parse($request->tanggal_sewa)->diffInDays($request->tanggal_kembali);
        $total  = $durasi * $jenis->harga_sewa;

        $buktiPath = null;
        if ($request->hasFile('bukti_bayar')) {
            $f = $request->file('bukti_bayar');
            $buktiPath = time().'_'.$f->getClientOriginalName();
            $f->move(public_path('storage/bukti_bayar'), $buktiPath);
        }

        // Validasi: transfer wajib upload bukti
        if (in_array($request->metode_bayar,['transfer_mandiri','transfer_bri']) && !$buktiPath) {
            return back()->withErrors(['bukti_bayar'=>'Bukti transfer wajib diupload.'])->withInput();
        }

        Transaksi::create([
            'user_id'         => Auth::id(),
            'jenis_motor_id'  => $jenis->id,
            'motor_id'        => $motor->id,
            'tanggal_sewa'    => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga'     => $total,
            'metode_bayar'    => $request->metode_bayar,
            'bukti_bayar'     => $buktiPath,
            'status_bayar'    => $buktiPath ? 'menunggu' : ($request->metode_bayar==='tunai' ? 'menunggu' : 'menunggu'),
            'status'          => 'pending',
        ]);

        return redirect()->route('customer.riwayat.index')
            ->with('success','Pemesanan berhasil! Silakan tunggu konfirmasi dari admin.');
    }

    // Riwayat transaksi customer
    public function index(Request $request)
    {
        $query = Transaksi::with('jenisMotor')
            ->where('user_id', Auth::id());

        if ($request->filled('status'))      $query->where('status',$request->status);
        if ($request->filled('search'))      $query->whereHas('jenisMotor',fn($q)=>$q->where('nama_jenis','like','%'.$request->search.'%'));

        $transaksis = $query->latest()->get();
        return view('customer.riwayat', compact('transaksis'));
    }

    // Batalkan transaksi
    public function cancel($id)
    {
        $t = Transaksi::where('user_id',Auth::id())->findOrFail($id);
        if ($t->status !== 'pending') {
            return back()->with('error','Transaksi tidak bisa dibatalkan.');
        }
        $t->update(['status'=>'dibatalkan']);
        return redirect()->route('customer.riwayat.index')->with('success','Transaksi berhasil dibatalkan.');
    }
}
