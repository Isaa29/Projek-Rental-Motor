<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rental Motor Jaya')</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body style="display:flex; flex-direction:column; min-height:100vh;">

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar">
        <div class="navbar-inner">

            {{-- Brand --}}
            <a href="{{ route('customer.beranda') }}" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:40px; height:auto;">
                <span class="navbar-brand-name">Rental Motor Jaya</span>
            </a>

            {{-- Menu Desktop (tablet+) --}}
            <div class="nav-menu">
                <a href="{{ route('customer.beranda') }}"
                    class="{{ request()->routeIs('customer.beranda') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('customer.rental.index') }}"
                    class="{{ request()->routeIs('customer.rental*') ? 'active' : '' }}">
                    Rental Motor
                </a>
                <a href="{{ route('customer.riwayat.index') }}"
                    class="{{ request()->routeIs('customer.riwayat*') ? 'active' : '' }}">
                    Riwayat
                </a>
                <a href="{{ route('customer.syarat') }}"
                    class="{{ request()->routeIs('customer.syarat') ? 'active' : '' }}">
                    Syarat
                </a>
                <a href="{{ route('customer.kontak') }}"
                    class="{{ request()->routeIs('customer.kontak') ? 'active' : '' }}">
                    Kontak
                </a>
            </div>

            {{-- Right side --}}
            <div class="navbar-right">
                <button class="btn-darkmode" onclick="toggleDarkMode()">
                    <span class="dm-icon">&#9790;</span>
                </button>

                {{-- User Dropdown --}}
                <div class="user-dropdown-wrap" id="userDropdownWrap">
                    <button class="user-trigger" id="userTrigger" type="button">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="ud-caret">&#9662;</span>
                    </button>

                    <div class="user-dropdown" id="userDropdown">
                        <div class="ud-header">
                            <div class="ud-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="ud-info">
                                <div class="ud-name">{{ Auth::user()->name }}</div>
                                <div class="ud-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="ud-divider"></div>
                        <a href="{{ route('customer.akun') }}" class="ud-item">
                            <span class="ud-item-icon">&#9881;</span>
                            Kelola Akun
                        </a>
                        <div class="ud-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="ud-item ud-item-logout">
                                <span class="ud-item-icon">&#10148;</span>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Hamburger — hanya tampil di mobile --}}
                <button class="btn-hamburger" id="hamburgerBtn">&#9776;</button>
            </div>
        </div>

        {{-- Mobile Menu — muncul saat hamburger diklik --}}
        <div class="nav-mobile" id="navMobile">
            {{-- Info user di atas mobile menu --}}
            <div class="nav-mobile-user">
                <div class="nmu-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="nmu-info">
                    <div class="nmu-name">{{ Auth::user()->name }}</div>
                    <div class="nmu-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="nav-mobile-divider"></div>

            <a href="{{ route('customer.beranda') }}"
               class="{{ request()->routeIs('customer.beranda') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('customer.rental.index') }}"
               class="{{ request()->routeIs('customer.rental*') ? 'active' : '' }}">Rental Motor</a>
            <a href="{{ route('customer.riwayat.index') }}"
               class="{{ request()->routeIs('customer.riwayat*') ? 'active' : '' }}">Riwayat</a>
            <a href="{{ route('customer.syarat') }}"
               class="{{ request()->routeIs('customer.syarat') ? 'active' : '' }}">Syarat &amp; Ketentuan</a>
            <a href="{{ route('customer.kontak') }}"
               class="{{ request()->routeIs('customer.kontak') ? 'active' : '' }}">Kontak</a>

            <div class="nav-mobile-divider"></div>
            <a href="{{ route('customer.akun') }}" class="nav-mobile-akun">
                <span>&#9881;</span> Kelola Akun
            </a>
            <div class="nav-mobile-footer">
                <form action="{{ route('logout') }}" method="POST" style="width:100%">
                    @csrf
                    <button type="submit" class="btn-logout-nav">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="flash-area">
        @if (session('success'))
            <div class="flash flash-ok">
                <span>{{ session('success') }}</span>
                <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif
        @if (session('error'))
            <div class="flash flash-error">
                <span>{{ session('error') }}</span>
                <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif
    </div>

    {{-- Konten --}}
    <main>@yield('content')</main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Rental Motor Jaya</h3>
                    <p>Motor berkualitas untuk perjalanan Anda.</p>
                    <p>Nyaman, terpercaya, harga terjangkau.</p>
                </div>
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <p>Telp: 08123456789</p>
                    <p>Email: jayamotor@gmail.com</p>
                    <p>Jl. Gajah Mada No.13, Jember</p>
                </div>
                <div class="footer-col">
                    <h3>Jam Operasional</h3>
                    <p>Senin - Sabtu: 08.00 - 20.00</p>
                    <p>Minggu: 09.00 - 17.00</p>
                </div>
            </div>
            <div class="footer-copy">
                &copy; {{ date('Y') }} Rental Motor Jaya. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
