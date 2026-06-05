@extends('layouts.admin')
@section('title', $jenis ? 'Edit Jenis Motor' : 'Tambah Jenis Motor')
@section('header', $jenis ? 'Edit Jenis Motor' : 'Tambah Jenis Motor')
@section('content')

<div style="max-width:680px;">
    <a href="{{ route('admin.jenis-motor.index') }}" class="back-link">&larr; Kembali ke Daftar Jenis Motor</a>

    @if($jenis && $jenis->foto)
    <div class="card" style="padding:16px;margin-bottom:18px;display:flex;align-items:center;gap:12px;">
        <img src="{{ asset('storage/motors/'.$jenis->foto) }}" style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
        <span style="font-size:13px;color:var(--text);">Foto saat ini. Upload baru untuk menggantinya.</span>
    </div>
    @endif

    <div class="card">
        <div class="card-header"><h3>{{ $jenis ? 'Edit Data Jenis Motor' : 'Form Tambah Jenis Motor' }}</h3></div>
        <div class="card-body">
            <form
                action="{{ $jenis ? route('admin.jenis-motor.update',$jenis->id) : route('admin.jenis-motor.store') }}"
                method="POST" enctype="multipart/form-data" id="formMotor">
                @csrf
                @if($jenis) @method('PUT') @endif

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Jenis Motor</label>
                        <input type="text" name="nama_jenis"
                            value="{{ old('nama_jenis', $jenis->nama_jenis ?? '') }}"
                            placeholder="Contoh: Honda Beat Street"
                            class="form-control {{ $errors->has('nama_jenis') ? 'is-invalid' : '' }}">
                        @error('nama_jenis')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Merk</label>
                        <select name="merk" class="form-control {{ $errors->has('merk') ? 'is-invalid' : '' }}">
                            <option value="">Pilih Merk</option>
                            @foreach(['Honda','Yamaha','Suzuki','Kawasaki'] as $m)
                            <option value="{{ $m }}" {{ old('merk',$jenis->merk??'') == $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                        @error('merk')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe</label>
                        <select name="tipe" class="form-control">
                            @foreach(['Matic','Manual','Sport'] as $t)
                            <option value="{{ $t }}" {{ old('tipe',$jenis->tipe??'') == $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Sewa/Hari (Rp)</label>
                        <input type="number" name="harga_sewa" min="1"
                            value="{{ old('harga_sewa', $jenis->harga_sewa ?? '') }}"
                            placeholder="Contoh: 80000"
                            class="form-control {{ $errors->has('harga_sewa') ? 'is-invalid' : '' }}">
                        @error('harga_sewa')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Motor</label>
                    <input type="file" name="foto" accept="image/*" class="form-control">
                    <span class="form-hint">Format JPG/PNG, maks 2MB.</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control"
                        placeholder="Deskripsi singkat motor...">{{ old('deskripsi', $jenis->deskripsi ?? '') }}</textarea>
                </div>

                <div style="display:flex;gap:10px;margin-top:6px;">
                    <button type="submit" class="btn btn-primary">
                        {{ $jenis ? 'Simpan Perubahan' : 'Simpan Jenis Motor' }}
                    </button>
                    <a href="{{ route('admin.jenis-motor.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
