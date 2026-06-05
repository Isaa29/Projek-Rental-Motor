@extends('layouts.customer')
@section('title', 'Beranda - Rental Motor Jaya')

@section('content')

    {{-- HERO BANNER  --}}
    <div style="background:linear-gradient(135deg,var(--primary) 0%,#3b6790 100%);color:#fff;padding:50px 20px;">
        <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr auto;gap:24px;align-items:center;">
            <div>
                <p
                    style="font-size:12px;background:rgba(255,255,255,.18);display:inline-block;
                      padding:4px 14px;border-radius:20px;margin-bottom:12px;">
                    Selamat datang kembali!
                </p>
                <h1 style="font-size:28px;font-weight:700;margin-bottom:10px;line-height:1.3;">
                    Halo, {{ Auth::user()->name }}!
                </h1>
                <p style="font-size:14px;color:rgba(255,255,255,.82);margin-bottom:22px;line-height:1.7;">
                    Mau kemana hari ini? Pilih motor terbaik dan mulai perjalananmu bersama kami.
                </p>
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <a href="{{ route('customer.rental.index') }}"
                        style="background:#fbbf24;color:#78350f;padding:12px 24px;border-radius:10px;
                          font-size:13px;font-weight:700;transition:background .2s;">
                        Sewa Motor Sekarang
                    </a>
                    <a href="{{ route('customer.riwayat.index') }}"
                        style="border:2px solid rgba(255,255,255,.6);color:#fff;padding:12px 24px;
                          border-radius:10px;font-size:13px;transition:border-color .2s;">
                        Lihat Riwayat Saya
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{--  BEBERAPA MOTOR RENTAL --}}
    <div class="page-wrap">

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
            <div>
                <h2 style="font-size:19px;font-weight:700;color:var(--primary);margin:0 0 3px;">
                    Motor Tersedia
                </h2>
                <p style="font-size:12px;color:var(--text);margin:0;">
                    Pilih dari berbagai jenis motor berkualitas
                </p>
            </div>
            <a href="{{ route('customer.rental.index') }}" style="font-size:13px;color:var(--primary);font-weight:500;">
                Lihat Semua &rarr;
            </a>
        </div>

        @if ($motor->isEmpty())
            <div class="empty-state">
                <h3>Belum Ada Motor Tersedia</h3>
                <p>Semua unit sedang disewa. Coba cek kembali nanti.</p>
            </div>
        @else
            <div class="motor-grid">
                @foreach ($motor as $jenis)
                    <div class="motor-card">
                        <div class="motor-foto">
                            @if ($jenis->foto)
                                <img src="{{ asset('storage/motors/' . $jenis->foto) }}" alt="{{ $jenis->nama_jenis }}">
                            @else
                                &#128663;
                            @endif
                        </div>
                        <div class="motor-body">
                            <h3>{{ $jenis->nama_jenis }}</h3>
                            <p class="merk">
                                {{ $jenis->merk }} &bull; {{ $jenis->tipe }}
                            </p>

                            <p class="harga">
                                Rp {{ number_format($jenis->harga_sewa, 0, ',', '.') }}/hari
                            </p>
                            <div class="motor-aksi">
                                <a href="{{ route('customer.rental.show', $jenis->id) }}" class="btn-card-det">Detail</a>
                                <a href="{{ route('customer.sewa.create', $jenis->id) }}" class="btn-card-sw">Sewa</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- ===== INFO KEUNGGULAN ===== --}}
    <div class="page-wrap" style="padding-top:0;padding-bottom:0;">
        <h2 style="font-size:19px;font-weight:700;color:var(--primary);margin-bottom:18px;">
            Kenapa Pilih Kami?
        </h2>
        <div class="feature-grid">
            <div class="card" style="text-align:center;padding:22px;">
                <div style="font-size:36px;margin-bottom:10px;">&#9881;</div>
                <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 5px;">
                    Motor Berkualitas
                </h3>
                <p style="font-size:12px;color:var(--text);margin:0;line-height:1.6;">
                    Semua unit terawat dan diservis rutin setiap bulan
                </p>
            </div>
            <div class="card card-body" style="text-align:center;padding:22px;">
                <div style="font-size:36px;margin-bottom:10px;">&#36;</div>
                <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 5px;">
                    Harga Terjangkau
                </h3>
                <p style="font-size:12px;color:var(--text);margin:0;line-height:1.6;">
                    Mulai dari Rp 75.000 per hari tanpa biaya tersembunyi
                </p>
            </div>
            <div class="card card-body" style="text-align:center;padding:22px;">
                <div style="font-size:36px;margin-bottom:10px;">&#9990;</div>
                <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 5px;">
                    Layanan Cepat
                </h3>
                <p style="font-size:12px;color:var(--text);margin:0;line-height:1.6;">
                    Proses mudah, konfirmasi cepat dari admin kami
                </p>
            </div>
        </div>
    </div>

    {{-- Promo --}}
    <div class="page-wrap">
        <div class="card"
            style="background:linear-gradient(135deg,var(--primary),#3b6790);border:none;padding:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <h3 style="font-size:16px;font-weight:700;color:#fff;margin:0 0 5px;">
                    Promo Sewa Weekend
                </h3>
                <p style="font-size:13px;color:rgba(255,255,255,.82);margin:0;">
                    Sewa Sabtu–Minggu dan dapatkan layanan antar-jemput gratis.
                    Hubungi kami via WhatsApp!
                </p>
            </div>
            <a href="https://wa.me/6281234567890" target="_blank"
                style="background:#fbbf24;color:#78350f;padding:10px 20px;border-radius:8px;
                  font-size:13px;font-weight:700;white-space:nowrap;">
                Hubungi WhatsApp
            </a>
        </div>
    </div>

@endsection
