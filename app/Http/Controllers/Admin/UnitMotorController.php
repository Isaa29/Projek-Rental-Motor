<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\JenisMotor;
use Illuminate\Http\Request;

class UnitMotorController extends Controller
{
    public function index(Request $request)
    {
        $query = Motor::with('jenisMotor');
        if ($request->filled('jenis'))  $query->where('jenis_motor_id', $request->jenis);
        if ($request->filled('status')) $query->where('status', $request->status);
        $units     = $query->get();
        $jenisList = JenisMotor::all();
        return view('admin.unit-motor', compact('units','jenisList'));
    }

    public function create() { return view('admin.form-unit-motor',['unit'=>null,'jenisList'=>JenisMotor::all()]); }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_motor_id' => 'required|exists:jenis_motors,id',
            'plat_nomor'     => 'required|string|unique:motors,plat_nomor',
            'tahun'          => 'required|integer|min:2000|max:2026',
            'warna'          => 'required|string',
            'status'         => 'required|in:tersedia,disewa',
        ]);
        Motor::create($request->only('jenis_motor_id','plat_nomor','tahun','warna','status','catatan'));
        return redirect()->route('admin.unit-motor.index')->with('success','Unit motor berhasil ditambahkan!');
    }

    public function edit($id) { return view('admin.form-unit-motor',['unit'=>Motor::findOrFail($id),'jenisList'=>JenisMotor::all()]); }

    public function update(Request $request, $id)
    {
        $unit = Motor::findOrFail($id);
        $request->validate([
            'jenis_motor_id' => 'required|exists:jenis_motors,id',
            'plat_nomor'     => 'required|string|unique:motors,plat_nomor,'.$id,
            'tahun'          => 'required|integer|min:2000|max:2026',
            'warna'          => 'required|string',
            'status'         => 'required|in:tersedia,disewa',
        ]);
        $unit->update($request->only('jenis_motor_id','plat_nomor','tahun','warna','status','catatan'));
        return redirect()->route('admin.unit-motor.index')->with('success','Unit motor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Motor::findOrFail($id)->delete();
        return redirect()->route('admin.unit-motor.index')->with('success','Unit motor berhasil dihapus!');
    }
}
