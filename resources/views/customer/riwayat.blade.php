@extends('layouts.customer')
@section('title','Riwayat Transaksi - Rental Motor Jaya')

@section('content')
<div class="page-wrap">

    <div class="page-hdr">
        <h1>Riwayat Transaksi</h1>
        <p>Semua aktivitas sewa motor Anda</p>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('customer.riwayat.index') }}"
          class="filter-bar" style="margin-bottom:20px;">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control" style="flex:1;min-width:160px;"
               placeholder="Cari nama motor...">
        <select name="status" class="form-control" style="width:160px;">
            <option value="">Semua Status</option>
            <option value="pending"     {{ request('status')=='pending'     ?'selected':'' }}>Menunggu</option>
            <option value="aktif"       {{ request('status')=='aktif'       ?'selected':'' }}>Aktif</option>
            <option value="selesai"     {{ request('status')=='selesai'     ?'selected':'' }}>Selesai</option>
            <option value="dibatalkan"  {{ request('status')=='dibatalkan'  ?'selected':'' }}>Dibatalkan</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('customer.riwayat.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    {{-- Daftar Transaksi --}}
    @forelse($transaksis as $t)
    <div class="transaksi-card">

        {{-- Kiri: foto + info --}}
        <div class="tc-kiri">
            <div class="tc-foto">
                @if($t->jenisMotor->foto)
                    <img src="{{ asset('storage/motors/' . $t->jenisMotor->foto) }}"
                         alt="{{ $t->jenisMotor->nama_jenis }}">
                @else
                    &#128663;
                @endif
            </div>
            <div>
                <p class="tc-nama">{{ $t->jenisMotor->nama_jenis }}</p>
                <p class="tc-merk">{{ $t->jenisMotor->merk }} &bull; {{ $t->jenisMotor->tipe }}</p>
                <p class="tc-tgl">
                    {{ $t->tanggal_sewa->format('d M Y') }} &rarr;
                    {{ $t->tanggal_kembali->format('d M Y') }}
                    <span style="color:#aaa;">({{ $t->durasi_hari }} hari)</span>
                </p>
                <p class="tc-metode" style="margin-top:3px;">
                    Bayar: {{ $t->metode_bayar_label }}
                </p>
            </div>
        </div>

        {{-- Kanan: harga + status --}}
        <div class="tc-kanan">
            <span class="tc-harga">
                Rp {{ number_format($t->total_harga,0,',','.') }}
            </span>

            {{-- Status transaksi --}}
            <span class="badge badge-{{ $t->status }}">
                {{ $t->status_label }}
            </span>

            {{-- Status pembayaran --}}
            <span class="badge badge-{{ $t->status_bayar }}"
                  style="font-size:10px;">
                {{ $t->status_bayar_label }}
            </span>

            {{-- Tombol batal --}}
            @if($t->status === 'pending')
            <form action="{{ route('customer.riwayat.cancel',$t->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-batal-tc">Batalkan</button>
            </form>
            @endif
        </div>

    </div>
    @empty
    <div class="empty-state">
        <div class="es-ico">&#128203;</div>
        <h3>Belum Ada Transaksi</h3>
        <p>Anda belum pernah melakukan sewa motor.</p>
        <a href="{{ route('customer.rental.index') }}" class="btn btn-primary">
            Mulai Sewa Sekarang
        </a>
    </div>
    @endforelse

</div>
@endsection
