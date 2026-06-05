@extends('layouts.admin')
@section('title', 'Transaksi')
@section('header', 'Data Transaksi')
@section('content')

    <div class="filter-bar" style="margin-bottom:16px;">
        <form method="GET" action="{{ route('admin.transaksi.index') }}"
            style="display:flex;gap:10px;flex-wrap:wrap;width:100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari customer / motor..."
                class="form-control" style="flex:1;min-width:160px;">
            <select name="status" class="form-control" style="width:140px;">
                <option value="">Semua Status</option>
                @foreach (['pending' => 'Pending', 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $k => $v)
                    <option value="{{ $k }}" {{ request('status') == $k ? 'selected' : '' }}>{{ $v }}
                    </option>
                @endforeach
            </select>
            <select name="status_bayar" class="form-control" style="width:160px;">
                <option value="">Semua Pembayaran</option>
                @foreach (['menunggu' => 'Menunggu', 'lunas' => 'Lunas', 'gagal' => 'Gagal'] as $k => $v)
                    <option value="{{ $k }}" {{ request('status_bayar') == $k ? 'selected' : '' }}>
                        {{ $v }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    <div class="card">
        <div class="tabel-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Jenis Motor</th>
                        <th>unit motor</th>
                        <th>Tgl Sewa</th>
                        <th>Tgl Kembali</th>
                        <th>Total</th>
                        <th>Metode Bayar</th>
                        <th>Bukti</th>
                        <th>Status Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                        <tr>
                            <td style="font-weight:600;">{{ $t->user->name }}</td>
                            <td>{{ $t->jenisMotor->nama_jenis }}</td>
                            <td>{{ $t->motor?->plat_nomor ?? '-' }}</td>
                            <td>{{ $t->tanggal_sewa->format('d M Y') }}</td>
                            <td>{{ $t->tanggal_kembali->format('d M Y') }}</td>
                            <td style="color:var(--primary);font-weight:600;">Rp
                                {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                            <td style="font-size:12px;">{{ $t->metode_bayar_label }}</td>
                            <td>
                                @if ($t->bukti_bayar)
                                    <a href="{{ asset('storage/bukti_bayar/' . $t->bukti_bayar) }}" target="_blank"
                                        class="btn btn-sm btn-success">
                                        Lihat
                                    </a>
                                @else
                                    <span style="font-size:11px;color:#aaa;">-</span>
                                @endif
                            </td>
                            {{-- Status Bayar --}}
                            <td>
                                <form method="POST" action="{{ route('admin.transaksi.verifikasiBayar', $t->id) }}">
                                    @csrf
                                    <input type="hidden" name="status_bayar" id="bayar_{{ $t->id }}"
                                        value="{{ $t->status_bayar }}">
                                    <select
                                        onchange="document.getElementById('bayar_{{ $t->id }}').value=this.value; this.closest('form').submit()"
                                        class="select-status s-{{ $t->status_bayar }}">
                                        @foreach (['menunggu' => 'Menunggu', 'lunas' => 'Lunas', 'gagal' => 'Gagal'] as $k => $v)
                                            <option value="{{ $k }}"
                                                {{ $t->status_bayar == $k ? 'selected' : '' }}>
                                                {{ $v }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>

                            {{-- Status Transaksi --}}
                            <td>
                                <form method="POST" action="{{ route('admin.transaksi.updateStatus', $t->id) }}">
                                    @csrf
                                    <input type="hidden" name="status" id="status_{{ $t->id }}"
                                        value="{{ $t->status }}">
                                    <select
                                        onchange="document.getElementById('status_{{ $t->id }}').value=this.value; this.closest('form').submit()"
                                        class="select-status s-{{ $t->status }}">
                                        @foreach (['pending' => 'Pending', 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $k => $v)
                                            <option value="{{ $k }}" {{ $t->status == $k ? 'selected' : '' }}>
                                                {{ $v }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align:center;padding:32px;color:#aaa;">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
