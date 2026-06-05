@extends('layouts.admin')
@section('title','Unit Motor')
@section('header','Unit Motor')
@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
    <span class="info-badge"">{{ $units->count() }} unit terdaftar</span>
    <a href="{{ route('admin.unit-motor.create') }}" class="btn btn-primary">+ Tambah Unit</a>
</div>

<div class="filter-bar" style="margin-bottom:16px;">
    <form method="GET" action="{{ route('admin.unit-motor.index') }}" style="display:flex;gap:10px;width:100%;flex-wrap:wrap;">
        <select name="jenis" class="form-control" style="flex:1;min-width:160px;">
            <option value="">Semua Jenis Motor</option>
            @foreach($jenisList as $j)
            <option value="{{ $j->id }}" {{ request('jenis')==$j->id?'selected':'' }}>{{ $j->nama_jenis }}</option>
            @endforeach
        </select>
        <select name="status" class="form-control" style="width:140px;">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status')=='tersedia'?'selected':'' }}>Tersedia</option>
            <option value="disewa"   {{ request('status')=='disewa'?'selected':'' }}>Disewa</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('admin.unit-motor.index') }}" class="btn btn-secondary">Reset</a>
    </form>
</div>

<div class="card">
    <div class="tabel-wrap">
        <table>
            <thead>
                <tr><th>Jenis Motor</th><th>Plat Nomor</th><th>Tahun</th><th>Warna</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($units as $u)
                <tr>
                    <td style="font-weight:600;">{{ $u->jenisMotor->nama_jenis }}</td>
                    <td style="font-family:monospace;letter-spacing:1px;">{{ $u->plat_nomor }}</td>
                    <td>{{ $u->tahun }}</td>
                    <td>{{ $u->warna }}</td>
                    <td><span class="badge badge-{{ $u->status }}">{{ ucfirst($u->status) }}</span></td>
                    <td>
                        <div class="aksi-btn">
                            <a href="{{ route('admin.unit-motor.edit',$u->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.unit-motor.destroy',$u->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus unit ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:32px;color:#aaa;">Belum ada unit motor.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
