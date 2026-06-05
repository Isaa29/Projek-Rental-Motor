@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard Admin')
@section('content')

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">Total Motor</div>
            <div class="stat-value">{{ $totalUnit }}</div>
            <div class="stat-sub">{{ $unitTersedia }} tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Customer</div>
            <div class="stat-value">{{ $totalCustomer }}</div>
            <div class="stat-sub">customer terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
            <div class="stat-sub">{{ $unitDisewa }} motor disewa</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-value" style="font-size:18px;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="stat-sub">dari transaksi selesai</div>
        </div>
    </div>

    <div style="display:grid;gap:20px;margin-bottom:24px;">

        {{-- Status Motor --}}
        <div class="card">
            <div class="card-header">
                <h3>Status Motor</h3>
            </div>
            <div class="card-body">
                <p style="font-size:13px;color:var(--text);margin-bottom:6px;">Tersedia</p>
                <div class="progress-bar-wrap" style="margin-bottom:14px;">
                    <div class="progress-bar" style="width:{{ $totalUnit > 0 ? ($unitTersedia / $totalUnit) * 100 : 0 }}%">
                    </div>
                </div>
                <p style="font-size:13px;color:var(--text);margin-bottom:6px;">Disewa</p>
                <div class="progress-bar-wrap">
                    <div class="progress-bar accent" style="width:{{ $totalUnit > 0 ? ($unitDisewa / $totalUnit) * 100 : 0 }}%">
                    </div>
                </div>
                <div style="display:flex;justify-content:space-between;margin-top:10px;font-size:12px;color:var(--text);">
                    <span>Tersedia: <strong>{{ $unitTersedia }}</strong></span>
                    <span>Disewa: <strong>{{ $unitDisewa }}</strong></span>
                </div>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="card">
            <div class="card-header">
                <h3>Aksi Cepat</h3>
            </div>
            <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <a href="{{ route('admin.unit-motor.create') }}" class="btn btn-primary" style="text-align:center;">
                    + Tambah Motor
                </a>

                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary" style="text-align:center;">
                    Lihat Transaksi
                </a>

                <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary" style="text-align:center;">
                    Data Customer
                </a>

                <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary" style="text-align:center;">
                    Laporan
                </a>
            </div>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="card">
        <div class="card-header">
            <h3>Transaksi Terbaru</h3>
            <a href="{{ route('admin.transaksi.index') }}" style="font-size:12px;color:var(--primary);">Lihat Semua</a>
        </div>
        <div class="tabel-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Motor</th>
                        <th>Tgl Sewa</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $t)
                        <tr>
                            <td style="font-weight:600;">{{ $t->user->name }}</td>
                            <td>{{ $t->jenisMotor->nama_jenis }}</td>
                            <td>{{ $t->tanggal_sewa->format('d M Y') }}</td>
                            <td style="color:var(--primary);font-weight:600;">Rp
                                {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                            <td><span class="badge badge-{{ $t->status }}">{{ ucfirst($t->status) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:32px;color:#aaa;">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
