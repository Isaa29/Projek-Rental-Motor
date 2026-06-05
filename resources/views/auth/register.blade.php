<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rental Motor Jaya</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo">
            <div class="logo-icon"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:50px; height:auto;"></div>
            <h1>Buat Akun Baru</h1>
            <p>Daftar dan mulai sewa motor</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" id="formRegister">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    placeholder="Nama lengkap Anda"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    placeholder="contoh@gmail.com"
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                    placeholder="Minimal 6 karakter"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    placeholder="Ulangi password"
                    class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;padding:11px;">Daftar Sekarang</button>
        </form>

        <p class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
        <p class="auth-back"><a href="{{ route('landing') }}">&larr; Kembali ke Beranda</a></p>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
