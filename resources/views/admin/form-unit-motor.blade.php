@extends('layouts.admin')
@section('title', $unit ? 'Edit Unit Motor' : 'Tambah Unit Motor')
@section('header', $unit ? 'Edit Unit Motor' : 'Tambah Unit Motor')
@section('content')
    <div style="max-width:560px;">
        <a href="{{ route('admin.unit-motor.index') }}" class="back-link">&larr; Kembali ke Daftar Unit</a>
        <div class="card">
            <div class="card-header">
                <h3>{{ $unit ? 'Edit Unit Motor' : 'Form Tambah Unit Motor' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ $unit ? route('admin.unit-motor.update', $unit->id) : route('admin.unit-motor.store') }}"
                    method="POST" id="formMotor">
                    @csrf
                    @if ($unit)
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label class="form-label">Jenis Motor</label>
                        <select name="jenis_motor_id"
                            class="form-control {{ $errors->has('jenis_motor_id') ? 'is-invalid' : '' }}">
                            <option value="">Pilih Jenis Motor</option>
                            @foreach ($jenisList as $j)
                                <option value="{{ $j->id }}"
                                    {{ old('jenis_motor_id', $unit->jenis_motor_id ?? '') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jenis }} ({{ $j->merk }})
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_motor_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Plat Nomor</label>
                            <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $unit->plat_nomor ?? '') }}"
                                placeholder="P 1234 AB"
                                class="form-control {{ $errors->has('plat_nomor') ? 'is-invalid' : '' }}">
                            @error('plat_nomor')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" min="2000" max="2026"
                                value="{{ old('tahun', $unit->tahun ?? '') }}"
                                class="form-control {{ $errors->has('tahun') ? 'is-invalid' : '' }}">
                            @error('tahun')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Warna</label>
                            <input type="text" name="warna" value="{{ old('warna', $unit->warna ?? '') }}"
                                placeholder="Contoh: Hitam"
                                class="form-control {{ $errors->has('warna') ? 'is-invalid' : '' }}">

                            @error('warna')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="tersedia"
                                    {{ old('status', $unit->status ?? 'tersedia') == 'tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="disewa" {{ old('status', $unit->status ?? '') == 'disewa' ? 'selected' : '' }}>
                                    Disewa</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catatan Internal (opsional)</label>
                        <textarea name="catatan" rows="2" class="form-control" placeholder="Catatan khusus untuk admin...">{{ old('catatan', $unit->catatan ?? '') }}</textarea>
                    </div>

                    <div style="display:flex;gap:10px;">
                        <button type="submit"
                            class="btn btn-primary">{{ $unit ? 'Simpan Perubahan' : 'Simpan Unit' }}</button>
                        <a href="{{ route('admin.unit-motor.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
