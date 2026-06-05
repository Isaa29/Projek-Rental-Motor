<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Motor Jaya</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="auth-page">
        <div class="auth-card">
            <a href="{{ route('landing') }}" class="back-link">&larr; Kembali ke Beranda</a>
            <div class="auth-logo">
                <div class="logo-icon"><img src="{{ asset('images/logo.png') }}" alt="Logo"
                        style="width:50px; height:auto;"></div>
                <h1>Rental Motor Jaya</h1>
                <p>Masuk ke akun Anda</p>
            </div>

            @if (session('error'))
                <div class="flash-msg flash-error" style="margin-bottom:16px;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" id="formLogin">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@gmail.com"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;padding:11px;">Masuk</button>
            </form>

            <p class="auth-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </p>
            <p class="auth-back">
                &nbsp;&nbsp;
                <button onclick="toggleDarkMode()"
                    style="background:none;border:none;font-size:12px;color:var(--text);cursor:pointer;">
                    Ganti Mode Gelap/Terang
                </button>
            </p>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
