<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor Jaya - Sewa Motor Terpercaya</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    {{-- ===== NAVBAR LANDING ===== --}}
    <nav class="land-navbar">
        <div class="land-navbar-inner">
            <a href="#beranda" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:50px; height:auto;">
                <span class="brand-name">Rental Motor Jaya</span>
            </a>
            <div class="land-nav-links">
                <a href="#beranda">Beranda</a>
                <a href="#daftar-motor">Daftar Motor</a>
                <a href="#tentang">Tentang Kami</a>
                <a href="#kontak">Kontak</a>
            </div>
            <div class="land-nav-right">
                <button class="btn-darkmode" onclick="toggleDarkMode()">
                    <span class="dm-icon">&#9790;</span>
                </button>
                <a href="{{ route('login') }}" class="btn-land-login">Login</a>
                <button class="btn-hamburger">&#9776;</button>
            </div>
        </div>
        <div class="land-mobile-menu" id="landMobileMenu">
            <a href="#beranda">Beranda</a>
            <a href="#daftar-motor">Daftar Motor</a>
            <a href="#tentang">Tentang Kami</a>
            <a href="#kontak">Kontak</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </nav>

    {{-- ===== HERO ===== --}}
    <section id="beranda" class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                <span class="hero-badge">Motor Terpercaya di Jember</span>
                <h1 class="hero-title">Bebas Kemana Saja<br><span>Bersama Kami</span></h1>
                <p class="hero-desc">Rental motor murah, bersih, dan terpercaya. Tersedia berbagai pilihan motor untuk
                    kebutuhan harian maupun wisata.</p>
                <div class="hero-btns">
                    <a href="{{ route('login') }}" class="btn-hero-primary">Rental Sekarang</a>
                    <a href="#daftar-motor" class="btn-hero-outline">Lihat Motor</a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hs-num">50+</div>
                        <div class="hs-lbl">Unit Motor</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hs-num">1000+</div>
                        <div class="hs-lbl">Customer</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hs-num">5 Thn</div>
                        <div class="hs-lbl">Pengalaman</div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-box">
                    <div class="hb-icon">
                        <img src="{{ asset('images/hero.jpg') }}" alt="Hero">
                    </div>
                    <p>Motor siap jalan untuk Anda</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== DAFTAR MOTOR ===== --}}
    <section id="daftar-motor" class="section section-bg">
        <div class="section-inner">
            <h2 class="section-title">Motor Unggulan</h2>
            <p class="section-sub">Pilihan motor terbaik siap menemani perjalanan Anda</p>

            <div class="motor-grid">
                @foreach ($motors as $motor)
                    <div class="motor-card">

                        <div class="motor-foto">
                            @if ($motor->foto)
                                <img src="{{ asset('storage/motors/' . $motor->foto) }}" alt="{{ $motor->nama_jenis }}">
                            @else
                                <div class="foto-placeholder">Foto</div>
                            @endif
                        </div>

                        <div class="motor-body">

                            <h3>{{ $motor->nama_jenis }}</h3>

                            <p class="merk">
                                {{ $motor->merk }} &bull; {{ $motor->tipe }}
                            </p>

                            <p class="harga">
                                Rp {{ number_format($motor->harga_sewa, 0, ',', '.') }}/hari
                            </p>

                            <span class="badge {{ $motor->tersedia_count > 0 ? 'badge-tersedia' : 'badge-disewa' }}">
                                {{ $motor->tersedia_count > 0 ? 'Tersedia' : 'Sedang Disewa' }}
                            </span>

                        </div>

                    </div>
                @endforeach
            </div>

            <div class="section-center">
                <a href="{{ route('login') }}" class="btn btn-primary">Lihat Semua Motor &rarr;</a>
            </div>
        </div>
    </section>

    {{-- ===== TENTANG KAMI ===== --}}
    <section id="tentang" class="section">
        <div class="section-inner">
            <div class="tentang-grid">
                <div class="tentang-text">
                    <h2>Tentang Rental Motor Jaya</h2>
                    <p>Rental Motor Jaya telah berdiri sejak 2019 dan menjadi salah satu penyedia jasa rental motor
                        terpercaya di Jember. Kami menyediakan berbagai pilihan motor berkualitas dengan harga yang
                        terjangkau.</p>
                    <p>Dengan pengalaman lebih dari 5 tahun, kami berkomitmen memberikan pelayanan terbaik. Semua unit
                        motor kami terawat dengan baik dan rutin diservis.</p>
                    <div class="tentang-stats">
                        <div class="ts-card">
                            <div class="num">50+</div>
                            <div class="lbl">Unit Motor</div>
                        </div>
                        <div class="ts-card">
                            <div class="num">1000+</div>
                            <div class="lbl">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>
                <div class="tentang-visual">
                    <h3>Misi Kami</h3>
                    <p>Memberikan pengalaman rental motor yang mudah, nyaman, dan terpercaya untuk semua orang.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== KONTAK ===== --}}
    <section id="kontak" class="section section-bg">
        <div class="section-inner">
            <h2 class="section-title">Hubungi Kami</h2>
            <p class="section-sub">Ada pertanyaan? Kami siap membantu</p>
            <div class="kontak-grid">
                <div class="kontak-card">
                    <div style="font-size:32px;margin-bottom:10px;color:var(--primary);">W</div>
                    <h3>WhatsApp</h3>
                    <a href="https://wa.me/6281234567890" target="_blank">081234567890</a>
                    <p style="font-size:11px;color:#9ca3af;margin-top:4px;">Klik untuk chat</p>
                </div>
                <div class="kontak-card">
                    <div style="font-size:32px;margin-bottom:10px;color:var(--primary);">L</div>
                    <h3>Alamat</h3>
                    <p>Jl. Gajah Mada No.13</p>
                    <p>Kota Jember, Jawa Timur</p>
                </div>
                <div class="kontak-card">
                    <div style="font-size:32px;margin-bottom:10px;color:var(--primary);">J</div>
                    <h3>Jam Operasional</h3>
                    <p>Senin - Sabtu: 08.00 - 20.00</p>
                    <p>Minggu: 09.00 - 17.00</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Rental Motor Jaya</h3>
                    <p>Motor berkualitas untuk perjalanan Anda.</p>
                </div>
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <p>08123456789</p>
                    <p>jayamotor@gmail.com</p>
                </div>
                <div class="footer-col">
                    <h3>Sosial Media</h3>
                    <p>Instagram: @rentalmotor.jaya</p>
                    <p>Facebook: Rental Motor Jaya</p>
                </div>
            </div>
            <div class="footer-copy">&copy; {{ date('Y') }} Rental Motor Jaya. All rights reserved.</div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
