@extends('layouts.customer')
@section('title','Form Sewa - Rental Motor Jaya')

@section('content')
<div class="sewa-wrap">

    <a href="{{ route('customer.rental.show',$jenis->id) }}" class="back-link">
        &larr; Kembali ke Detail Motor
    </a>

    <div class="page-hdr">
        <h1>Form Sewa Motor</h1>
        <p>Isi data sewa dengan lengkap dan benar</p>
    </div>

    {{-- Info Motor yang Dipilih --}}
    <div class="info-motor-sewa">
        <div class="ims-foto">
            @if($jenis->foto)
                <img src="{{ asset('storage/motors/'.$jenis->foto) }}"
                     alt="{{ $jenis->nama_jenis }}">
            @else
                &#128663;
            @endif
        </div>
        <div>
            <p class="ims-nama">{{ $jenis->nama_jenis }}</p>
            <p class="ims-merk">{{ $jenis->merk }} &bull; {{ $jenis->tipe }}</p>
            <p class="ims-harga">
                Rp {{ number_format($jenis->harga_sewa,0,',','.') }}/hari
            </p>
        </div>
    </div>

    {{-- Form Sewa --}}
    <div class="card">
        <div class="card-header"><h3>Data Sewa</h3></div>
        <div class="card-body">

            <form action="{{ route('customer.sewa.store') }}" method="POST"
                  enctype="multipart/form-data"
                  id="formSewa"
                  data-harga="{{ $jenis->harga_sewa }}">
                @csrf
                <input type="hidden" name="jenis_motor_id" value="{{ $jenis->id }}">

                {{-- Nama Customer (readonly) --}}
                <div class="form-group">
                    <label class="form-label">Nama Penyewa</label>
                    <input type="text" value="{{ Auth::user()->name }}" readonly
                           class="form-control"
                           style="background:#f9f9f9;cursor:not-allowed;color:var(--text);">
                </div>

                {{-- Tanggal Sewa & Kembali --}}
                <div class="form-grid2">
                    <div class="form-group">
                        <label class="form-label">Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" id="tanggalSewa"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('tanggal_sewa') }}"
                               class="form-control {{ $errors->has('tanggal_sewa') ? 'is-invalid':'' }}">
                        @error('tanggal_sewa')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggalKembali"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               value="{{ old('tanggal_kembali') }}"
                               class="form-control {{ $errors->has('tanggal_kembali') ? 'is-invalid':'' }}">
                        @error('tanggal_kembali')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Kalkulasi Harga Otomatis --}}
                <div id="kalkBox" class="kalk-box">
                    <div class="kalk-row">
                        <span class="kalk-key">Durasi Sewa</span>
                        <span class="kalk-val" id="kalkHari">-</span>
                    </div>
                    <div class="kalk-row">
                        <span class="kalk-key">Harga/Hari</span>
                        <span class="kalk-val">
                            Rp {{ number_format($jenis->harga_sewa,0,',','.') }}
                        </span>
                    </div>
                    <div class="kalk-total">
                        <span class="key">Total Harga</span>
                        <span class="val" id="kalkTotal">Rp 0</span>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="form-group" style="margin-top:18px;">
                    <label class="form-label">Metode Pembayaran</label>
                    <div class="metode-grid">

                        {{-- Transfer Mandiri --}}
                        <div class="metode-opt">
                            <input type="radio" name="metode_bayar"
                                   id="metodeMandiri" value="transfer_mandiri"
                                   {{ old('metode_bayar') == 'transfer_mandiri' ? 'checked':'' }}>
                            <label for="metodeMandiri" class="metode-lbl">
                                <div class="m-ico">B</div>
                                <div class="m-name">Bank Mandiri</div>
                                <div class="m-sub">Transfer</div>
                            </label>
                        </div>

                        {{-- Transfer BRI --}}
                        <div class="metode-opt">
                            <input type="radio" name="metode_bayar"
                                   id="metodeBRI" value="transfer_bri"
                                   {{ old('metode_bayar') == 'transfer_bri' ? 'checked':'' }}>
                            <label for="metodeBRI" class="metode-lbl">
                                <div class="m-ico">B</div>
                                <div class="m-name">Bank BRI</div>
                                <div class="m-sub">Transfer</div>
                            </label>
                        </div>

                        {{-- Tunai --}}
                        <div class="metode-opt">
                            <input type="radio" name="metode_bayar"
                                   id="metodeTunai" value="tunai"
                                   {{ (old('metode_bayar','tunai') == 'tunai') ? 'checked':'' }}>
                            <label for="metodeTunai" class="metode-lbl">
                                <div class="m-ico">T</div>
                                <div class="m-name">Tunai</div>
                                <div class="m-sub">Bayar di tempat</div>
                            </label>
                        </div>

                    </div>
                    @error('metode_bayar')
                    <span class="invalid-feedback" style="display:block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Info Rekening Mandiri --}}
                <div id="rekMandiri" class="rek-box {{ old('metode_bayar') == 'transfer_mandiri' ? 'show':'' }}">
                    <p style="font-size:12px;font-weight:700;color:var(--primary);margin-bottom:10px;">
                        Nomor Rekening Bank Mandiri
                    </p>
                    <div class="rek-row">
                        <span class="rek-key">Nama Rekening</span>
                        <span class="rek-val">Rental Motor Jaya</span>
                    </div>
                    <div class="rek-row">
                        <span class="rek-key">Nomor Rekening</span>
                        <span class="rek-val">1320 0123 4567 8</span>
                    </div>
                    <div class="rek-row">
                        <span class="rek-key">Nama Bank</span>
                        <span class="rek-val">Bank Mandiri</span>
                    </div>
                    <p class="rek-note">
                        * Transfer sesuai total harga yang tertera, lalu upload bukti transfer di bawah.
                    </p>
                </div>

                {{-- Info Rekening BRI --}}
                <div id="rekBRI" class="rek-box {{ old('metode_bayar') == 'transfer_bri' ? 'show':'' }}">
                    <p style="font-size:12px;font-weight:700;color:var(--primary);margin-bottom:10px;">
                        Nomor Rekening Bank BRI
                    </p>
                    <div class="rek-row">
                        <span class="rek-key">Nama Rekening</span>
                        <span class="rek-val">Rental Motor Jaya</span>
                    </div>
                    <div class="rek-row">
                        <span class="rek-key">Nomor Rekening</span>
                        <span class="rek-val">0987 0123 4567 890</span>
                    </div>
                    <div class="rek-row">
                        <span class="rek-key">Nama Bank</span>
                        <span class="rek-val">Bank BRI</span>
                    </div>
                    <p class="rek-note">
                        * Transfer sesuai total harga yang tertera, lalu upload bukti transfer di bawah.
                    </p>
                </div>

                {{-- Upload Bukti Transfer --}}
                <div id="buktiWrap"
                     class="form-group"
                     style="{{ in_array(old('metode_bayar'),['transfer_mandiri','transfer_bri']) ? '' : 'display:none;' }} margin-top:14px;">
                    <label class="form-label">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_bayar" accept="image/*"
                           class="form-control {{ $errors->has('bukti_bayar') ? 'is-invalid':'' }}">
                    @error('bukti_bayar')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <span class="form-hint">Format JPG/PNG, maks 3MB.</span>
                </div>

                {{-- Info tunai --}}
                <div id="infoTunai"
                     class="rek-box {{ old('metode_bayar','tunai') == 'tunai' ? 'show':'' }}"
                     style="margin-top:14px;">
                    <p style="font-size:13px;color:var(--primary);margin:0;">
                        Pembayaran dilakukan secara tunai saat pengambilan motor di lokasi kami.
                        Harap membawa uang pas sesuai total harga.
                    </p>
                </div>

                {{-- Tombol Submit --}}
                <div style="display:flex;gap:10px;margin-top:22px;">
                    <button type="submit" class="btn btn-primary"
                            style="flex:1;padding:12px;font-size:14px;">
                        Konfirmasi Sewa
                    </button>
                    <a href="{{ route('customer.rental.index') }}"
                       class="btn btn-secondary"
                       style="flex:1;padding:12px;font-size:14px;text-align:center;">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Catatan --}}
    <div style="margin-top:14px;padding:14px 16px;background:var(--white);
                border-radius:10px;border:1px solid var(--border);font-size:12px;color:var(--text);
                line-height:1.7;">
        <strong style="color:var(--primary);">Catatan:</strong>
        Unit motor akan dialokasikan oleh admin setelah konfirmasi. Status pemesanan Anda
        dapat dipantau di halaman
        <a href="{{ route('customer.riwayat.index') }}"
           style="color:var(--primary);font-weight:600;">Riwayat Transaksi</a>.
        Jika ada pertanyaan, hubungi kami via
        <a href="https://wa.me/6281234567890" target="_blank"
           style="color:var(--primary);font-weight:600;">WhatsApp</a>.
    </div>

</div>
@endsection

