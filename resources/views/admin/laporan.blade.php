@extends('layouts.admin')
@section('title','Laporan')
@section('header','Laporan Rental')
@section('content')

<div class="card" style="padding:18px;margin-bottom:18px;">
    <form method="GET" action="{{ route('admin.laporan.index') }}" style="display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
        <div>
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-control" style="width:150px;">
                <option value="">Semua Bulan</option>
                @php $bln = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']; @endphp
                @for($i=1;$i<=12;$i++)
                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}" {{ request('bulan')==str_pad($i,2,'0',STR_PAD_LEFT)?'selected':'' }}>
                    {{ $bln[$i] }}
                </option>
                @endfor
            </select>
        </div>
        <div>
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-control" style="width:110px;">
                <option value="">Semua</option>
                @for($y=2023;$y<=2026;$y++)
                <option value="{{ $y }}" {{ request('tahun')==$y?'selected':'' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Reset</a>
    </form>
</div>

<div class="stat-grid" style="grid-template-columns:1fr 1fr;margin-bottom:18px;">
    <div class="stat-card">
        <div class="stat-label">Total Transaksi Selesai</div>
        <div class="stat-value">{{ $totalTransaksi }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Pendapatan</div>
        <div class="stat-value" style="font-size:18px;">Rp {{ number_format($totalPendapatan,0,',','.') }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3>Laporan Transaksi Selesai</h3></div>
    <div class="tabel-wrap">
        <table>
            <thead>
                <tr><th>No</th><th>Customer</th><th>Jenis Motor</th><th>Tgl Sewa</th><th>Tgl Kembali</th><th>Durasi</th><th>Metode Bayar</th><th>Total</th></tr>
            </thead>
            <tbody>
                @forelse($transaksis as $i=>$t)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td style="font-weight:600;">{{ $t->user->name }}</td>
                    <td>{{ $t->jenisMotor->nama_jenis }}</td>
                    <td>{{ $t->tanggal_sewa->format('d M Y') }}</td>
                    <td>{{ $t->tanggal_kembali->format('d M Y') }}</td>
                    <td>{{ $t->durasi_hari }} hari</td>
                    <td>{{ $t->metode_bayar_label }}</td>
                    <td style="color:var(--primary);font-weight:600;">Rp {{ number_format($t->total_harga,0,',','.') }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:32px;color:#aaa;">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
