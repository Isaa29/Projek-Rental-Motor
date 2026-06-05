<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisMotor::withCount([
            'motors as tersedia_count' => fn($q)=>$q->where('status','tersedia'),
            'motors as total_unit',
        ]);

        if ($request->filled('merk'))   $query->where('merk',$request->merk);
        if ($request->filled('status')) {
            if ($request->status === 'tersedia') $query->having('tersedia_count','>',0);
            if ($request->status === 'habis')    $query->having('tersedia_count','=',0);
        }

        $jenisList = $query->get();
        $merks     = JenisMotor::distinct()->pluck('merk');

        return view('customer.rental', compact('jenisList','merks'));
    }

    public function show($id)
    {
        $jenis = JenisMotor::withCount([
            'motors as tersedia_count' => fn($q)=>$q->where('status','tersedia'),
        ])->findOrFail($id);
        return view('customer.detail-motor', compact('jenis'));
    }

    public function search(Request $request)
    {
        $q     = $request->get('q','');
        $merk  = $request->get('merk','');
        $status= $request->get('status','');

        $query = JenisMotor::withCount([
            'motors as tersedia_count' => fn($q)=>$q->where('status','tersedia'),
        ]);
        if ($q)    $query->where(fn($qq)=>$qq->where('nama_jenis','like',"%$q%")->orWhere('merk','like',"%$q%"));
        if ($merk) $query->where('merk',$merk);
        if ($status === 'tersedia') $query->having('tersedia_count','>',0);
        if ($status === 'habis')    $query->having('tersedia_count','=',0);

        return response()->json($query->get()->map(fn($j)=>[
            'id'           => $j->id,
            'nama_jenis'   => $j->nama_jenis,
            'merk'         => $j->merk,
            'tipe'         => $j->tipe,
            'harga_format' => 'Rp '.number_format($j->harga_sewa,0,',','.'),
            'harga_sewa'   => $j->harga_sewa,
            'tersedia'     => $j->tersedia_count,
            'foto_url' => $j->foto
                ? asset('storage/motors/' . $j->foto)
                : null,
            'detail_url'   => route('customer.rental.show',$j->id),
            'sewa_url'     => route('customer.sewa.create',$j->id),
        ]));
    }
}
