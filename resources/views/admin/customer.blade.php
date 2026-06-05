@extends('layouts.admin')
@section('title','Customer')
@section('header','Data Customer')
@section('content')

<div class="filter-bar" style="margin-bottom:16px;">
    <form method="GET" action="{{ route('admin.customer.index') }}" style="display:flex;gap:10px;width:100%;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
            class="form-control" style="flex:1;">
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">Reset</a>
    </form>
</div>

<div class="card">
    <div class="tabel-wrap">
        <table>
            <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Transaksi</th><th>Bergabung</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($customers as $i=>$c)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div style="width:30px;height:30px;border-radius:50%;background:var(--secondary);display:flex;align-items:center;justify-content:center;color:var(--primary);font-weight:700;font-size:12px;">
                                {{ strtoupper(substr($c->name,0,1)) }}
                            </div>
                            <span style="font-weight:600;">{{ $c->name }}</span>
                        </div>
                    </td>
                    <td>{{ $c->email }}</td>
                    <td><span class="badge badge-aktif">{{ $c->transaksis_count }} transaksi</span></td>
                    <td>{{ $c->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="aksi-btn">
                            <a href="{{ route('admin.customer.show',$c->id) }}" class="btn btn-sm btn-success">Riwayat</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:32px;color:#aaa;">Belum ada customer.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
