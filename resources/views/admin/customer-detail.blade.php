@extends('layouts.admin')
@section('title','Detail Customer')
@section('header','Detail Customer')
@section('content')

<a href="{{ route('admin.customer.index') }}" class="back-link">&larr; Kembali ke Daftar Customer</a>

<div class="card" style="padding:20px;margin-bottom:18px;display:flex;align-items:center;gap:16px;">
    <div style="width:52px;height:52px;border-radius:50%;background:var(--secondary);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:20px;font-weight:700;">
        {{ strtoupper(substr($customer->name,0,1)) }}
    </div>
    <div>
        <h2 style="font-size:18px;font-weight:700;color:var(--primary);margin:0 0 4px;">{{ $customer->name }}</h2>
        <p style="margin:0;font-size:13px;color:var(--text);">{{ $customer->email }}</p>
        <p style="margin:4px 0 0;font-size:12px;color:#aaa;">Bergabung: {{ $customer->created_at->format('d M Y') }}</p>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3>Riwayat Transaksi ({{ $transaksis->count() }})</h3></div>
    <div class="tabel-wrap">
        <table>
            <thead><tr><th>Jenis Motor</th><th>Tgl Sewa</th><th>Tgl Kembali</th><th>Durasi</th><th>Total</th><th>Metode Bayar</th><th>Status Bayar</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($transaksis as $t)
                <tr>
                    <td style="font-weight:600;">{{ $t->jenisMotor->nama_jenis }}</td>
                    <td>{{ $t->tanggal_sewa->format('d M Y') }}</td>
                    <td>{{ $t->tanggal_kembali->format('d M Y') }}</td>
                    <td>{{ $t->durasi_hari }} hari</td>
                    <td style="color:var(--primary);font-weight:600;">Rp {{ number_format($t->total_harga,0,',','.') }}</td>
                    <td style="font-size:12px;">{{ $t->metode_bayar_label }}</td>
                    <td><span class="badge badge-{{ $t->status_bayar }}">{{ $t->status_bayar_label }}</span></td>
                    <td><span class="badge badge-{{ $t->status }}">{{ $t->status_label }}</span></td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:32px;color:#aaa;">Belum ada riwayat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
