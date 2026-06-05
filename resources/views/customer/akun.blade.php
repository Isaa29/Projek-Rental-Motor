@extends('layouts.customer')

@section('title', 'Kelola Akun — Rental Motor Jaya')

@section('content')
<div class="page-wrap" style="max-width:620px;">

    <a href="{{ route('customer.beranda') }}" class="back-link">&#8592; Kembali ke Beranda</a>

    <div class="page-hdr">
        <h1>Kelola Akun</h1>
        <p>Perbarui informasi profil dan keamanan akun Anda.</p>
    </div>

    {{-- Avatar Card --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card-body" style="display:flex;align-items:center;gap:16px;">
            <div class="akun-avatar-lg">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-size:16px;font-weight:700;color:var(--primary);">{{ $user->name }}</div>
                <div style="font-size:13px;color:var(--text);margin-top:2px;">{{ $user->email }}</div>
                <div style="font-size:11px;color:var(--text);margin-top:4px;">
                    Bergabung sejak {{ $user->created_at->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Form Edit --}}
    <div class="card">
        <div class="card-header">
            <h3>Edit Informasi Akun</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.akun.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid2">
                    {{-- Nama --}}
                    <div class="form-group">
                        <label class="form-label" for="name">Nama Lengkap</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Nama lengkap Anda"
                        >
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email', $user->email) }}"
                            placeholder="email@contoh.com"
                        >
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Divider password --}}
                <div style="border-top:1px solid var(--border);margin:18px 0 16px;"></div>
                <p style="font-size:12px;color:var(--text);margin-bottom:14px;">
                    Kosongkan kolom password jika tidak ingin mengubah password.
                </p>

                <div class="form-grid2">
                    {{-- Password Baru --}}
                    <div class="form-group">
                        <label class="form-label" for="password">Password Baru</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Minimal 6 karakter"
                            autocomplete="new-password"
                        >
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password baru"
                            autocomplete="new-password"
                        >
                    </div>
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:6px;">
                    <a href="{{ route('customer.beranda') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
