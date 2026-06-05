@extends('layouts.customer')
@section('title', $jenis->nama_jenis . ' - Rental Motor Jaya')

@section('content')
<div class="page-wrap">

    <a href="{{ route('customer.rental.index') }}" class="back-link">
        &larr; Kembali ke Daftar Motor
    </a>

    <div class="detail-card">
        <div class="detail-grid">

            {{-- Foto --}}
            <div class="detail-foto">
                @if($jenis->foto)
                    <img src="{{ asset('storage/motors/'.$jenis->foto) }}"
                         alt="{{ $jenis->nama_jenis }}">
                @else
                    <span class="noimg">&#128663;</span>
                @endif
            </div>

            {{-- Info --}}
            <div class="detail-info">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:4px;">
                    <h1 class="detail-nama">{{ $jenis->nama_jenis }}</h1>
                    @if($jenis->tersedia_count > 0)
                        <span class="badge badge-tersedia">Tersedia</span>
                    @else
                        <span class="badge badge-disewa">Habis</span>
                    @endif
                </div>

                <div class="detail-harga">
                    Rp {{ number_format($jenis->harga_sewa,0,',','.') }}
                    <span>/hari</span>
                </div>

                <div class="detail-row">
                    <span class="key">Merk</span>
                    <span class="val">{{ $jenis->merk }}</span>
                </div>
                <div class="detail-row">
                    <span class="key">Tipe</span>
                    <span class="val">{{ $jenis->tipe }}</span>
                </div>
                <div class="detail-row">
                    <span class="key">Ketersediaan</span>
                    <span class="val">
                        @if($jenis->tersedia_count > 0)
                            {{ $jenis->tersedia_count }} unit tersedia
                        @else
                            Semua unit sedang disewa
                        @endif
                    </span>
                </div>
                <div class="detail-row" style="border-bottom:none;">
                    <span class="key">Harga Sewa</span>
                    <span class="val" style="color:var(--primary);">
                        Rp {{ number_format($jenis->harga_sewa,0,',','.') }} / hari
                    </span>
                </div>

                @if($jenis->deskripsi)
                <p class="detail-desc">{{ $jenis->deskripsi }}</p>
                @endif

                <div style="margin-top:18px;">
                    @if($jenis->tersedia_count > 0)
                        <a href="{{ route('customer.sewa.create',$jenis->id) }}"
                           style="display:block;text-align:center;background:var(--primary);color:#fff;
                                  padding:13px;border-radius:10px;font-size:14px;font-weight:700;
                                  transition:background .2s;">
                            Sewa Motor Ini
                        </a>
                    @else
                        <button disabled
                            style="display:block;width:100%;text-align:center;
                                   background:#F0F0F0;color:#9CA3AF;padding:13px;
                                   border-radius:10px;font-size:14px;font-weight:700;
                                   border:none;cursor:not-allowed;">
                            Sedang Tidak Tersedia
                        </button>
                    @endif
                </div>

                {{-- Syarat singkat --}}
                <div style="margin-top:14px;padding:12px;background:var(--bg);border-radius:8px;
                            border:1px solid var(--border);">
                    <p style="font-size:11px;color:var(--text);margin:0;line-height:1.7;">
                        Dengan menyewa, Anda menyetujui
                        <a href="{{ route('customer.syarat') }}"
                           style="color:var(--primary);font-weight:600;">
                            Syarat &amp; Ketentuan
                        </a>
                        yang berlaku.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
