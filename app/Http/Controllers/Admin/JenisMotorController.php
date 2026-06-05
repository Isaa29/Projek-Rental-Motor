<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisMotorController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisMotor::withCount(['motors','motors as tersedia_count' => fn($q)=>$q->where('status','tersedia')]);
        if ($request->filled('merk'))   $query->where('merk', $request->merk);
        if ($request->filled('search')) $query->where('nama_jenis','like','%'.$request->search.'%');
        return view('admin.jenis-motor', ['jenisList' => $query->get()]);
    }

    public function create() { return view('admin.form-jenis-motor', ['jenis'=>null]); }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis'  => 'required|string|max:100',
            'merk'        => 'required|string',
            'tipe'        => 'required|string',
            'harga_sewa'  => 'required|integer|min:1',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'   => 'nullable|string',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $f = $request->file('foto');
            $foto = time().'_'.$f->getClientOriginalName();
            $f->move(public_path('storage/motors'), $foto);
        }

        JenisMotor::create([...$request->only('nama_jenis','merk','tipe','harga_sewa','deskripsi'), 'foto'=>$foto]);
        return redirect()->route('admin.jenis-motor.index')->with('success','Jenis motor berhasil ditambahkan!');
    }

    public function edit($id) { return view('admin.form-jenis-motor', ['jenis'=>JenisMotor::findOrFail($id)]); }

    public function update(Request $request, $id)
    {
        $jenis = JenisMotor::findOrFail($id);
        $request->validate([
            'nama_jenis' => 'required|string|max:100',
            'merk'       => 'required|string',
            'tipe'       => 'required|string',
            'harga_sewa' => 'required|integer|min:1',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'  => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {

        if ($jenis->foto) {
            Storage::disk('public')->delete($jenis->foto);
        }

            $f = $request->file('foto');
            $foto = time().'_'.$f->getClientOriginalName();
            $f->move(public_path('storage/motors'), $foto);

        } else {
            $foto = $jenis->foto;
        }

        $jenis->update([...$request->only('nama_jenis','merk','tipe','harga_sewa','deskripsi'), 'foto'=>$foto]);
        return redirect()->route('admin.jenis-motor.index')->with('success','Jenis motor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenis = JenisMotor::findOrFail($id);
        if ($jenis->foto) {
            if ($jenis->foto && file_exists(public_path('storage/motors/'.$jenis->foto))) {
                unlink(public_path('storage/motors/'.$jenis->foto));
            }
        }
        $jenis->delete();
        return redirect()->route('admin.jenis-motor.index')->with('success','Jenis motor berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $q     = $request->get('q','');
        $merk  = $request->get('merk','');
        $query = JenisMotor::withCount([
            'motors',
            'motors as tersedia_count' => fn($q)=>$q->where('status','tersedia'),
        ]);
        if ($q)    $query->where('nama_jenis','like',"%$q%");
        if ($merk) $query->where('merk',$merk);

        return response()->json($query->get()->map(fn($j)=>[
            'id'             => $j->id,
            'nama_jenis'     => $j->nama_jenis,
            'merk'           => $j->merk,
            'tipe'           => $j->tipe,
            'harga_format'   => 'Rp '.number_format($j->harga_sewa,0,',','.'),
            'harga_sewa'     => $j->harga_sewa,
            'total_unit'     => $j->motors_count,
            'tersedia'       => $j->tersedia_count,
            'foto_url' => $j->foto
                ? asset('storage/motors/' . $j->foto)
                : null,
            'edit_url'       => route('admin.jenis-motor.edit',$j->id),
            'delete_url'     => route('admin.jenis-motor.destroy',$j->id),
            'unit_url'       => route('admin.unit-motor.index',['jenis'=>$j->id]),
        ]));
    }
}
