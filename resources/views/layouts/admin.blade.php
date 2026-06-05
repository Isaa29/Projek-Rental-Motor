<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Rental Motor Jaya</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <div class="admin-wrapper">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:50px; height:auto;">
                <span class="sidebar-logo-text">Rental Motor Jaya</span>
            </div>
            <div class="sidebar-user">
                <div class="su-label">Masuk sebagai</div>
                <div class="su-name">{{ Auth::user()->name }}</div>
                <span class="su-role">Admin</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-dot"></span> Dashboard
                </a>
                <a href="{{ route('admin.jenis-motor.index') }}"
                    class="{{ request()->routeIs('admin.jenis-motor*') ? 'active' : '' }}">
                    <span class="nav-dot"></span> Jenis Motor
                </a>
                <a href="{{ route('admin.unit-motor.index') }}"
                    class="{{ request()->routeIs('admin.unit-motor*') ? 'active' : '' }}">
                    <span class="nav-dot"></span> Data Motor
                </a>
                <a href="{{ route('admin.customer.index') }}"
                    class="{{ request()->routeIs('admin.customer*') ? 'active' : '' }}">
                    <span class="nav-dot"></span> Data Customer
                </a>
                <a href="{{ route('admin.transaksi.index') }}"
                    class="{{ request()->routeIs('admin.transaksi*') ? 'active' : '' }}">
                    <span class="nav-dot"></span> Transaksi
                </a>
                <a href="{{ route('admin.laporan.index') }}"
                    class="{{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                    <span class="nav-dot"></span> Laporan
                </a>
            </nav>
            <div class="sidebar-logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- ===== MAIN ===== --}}
        <div class="admin-main">

            {{-- Topbar --}}
            <header class="topbar">
                <div class="topbar-left">
                    <button class="btn-hamburger">&#9776;</button>
                    <span class="topbar-title">@yield('header', 'Dashboard')</span>
                </div>
                <div class="topbar-right">
                    <button class="btn-darkmode" onclick="toggleDarkMode()">
                        <span class="dm-icon">&#9790;</span>
                    </button>
                    <span class="topbar-username">{{ Auth::user()->name }}</span>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="flash-area">
                @if (session('success'))
                    <div class="flash-msg flash-success">
                        <span>{{ session('success') }}</span>
                        <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="flash-msg flash-error">
                        <span>{{ session('error') }}</span>
                        <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
            </div>

            {{-- Konten --}}
            <main class="page-content">
                @yield('content')
            </main>

            <footer class="admin-footer">
                &copy; {{ date('Y') }} Rental Motor Jaya. All rights reserved.
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
