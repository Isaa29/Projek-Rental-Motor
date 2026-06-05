@extends('layouts.customer')
@section('title','Syarat & Ketentuan - Rental Motor Jaya')

@section('content')
<div class="page-wrap" style="max-width:800px;">

    <div class="page-hdr">
        <h1>Syarat &amp; Ketentuan</h1>
        <p>Harap baca dengan seksama sebelum melakukan penyewaan motor</p>
    </div>

    {{-- Poin 1 --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-header">
            <h3>1. Persyaratan Penyewa</h3>
        </div>
        <div class="card-body">
            <ul style="padding-left:18px;font-size:13px;color:var(--text);line-height:2.1;list-style:disc;">
                <li>Penyewa minimal berusia 17 tahun dan memiliki SIM C yang masih berlaku.</li>
                <li>Penyewa wajib menunjukkan KTP atau kartu identitas resmi lainnya.</li>
                <li>Penyewa wajib memberikan nomor telepon aktif yang bisa dihubungi.</li>
                <li>Penyewa harus memiliki akun terdaftar di website Rental Motor Jaya.</li>
            </ul>
        </div>
    </div>

    {{-- Poin 2 --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-header">
            <h3>2. Ketentuan Penyewaan</h3>
        </div>
        <div class="card-body">
            <ul style="padding-left:18px;font-size:13px;color:var(--text);line-height:2.1;list-style:disc;">
                <li>Pemesanan dilakukan minimal 1 hari sebelum tanggal sewa.</li>
                <li>Harga sewa dihitung per hari (24 jam), tidak termasuk bahan bakar.</li>
                <li>Motor harus dikembalikan dalam kondisi bersih dan sesuai kondisi awal.</li>
                <li>Keterlambatan pengembalian dikenakan biaya tambahan sesuai tarif harian.</li>
                <li>Penyewa bertanggung jawab penuh atas kerusakan atau kehilangan motor selama masa sewa.</li>
                <li>Unit motor yang dialokasikan ditentukan oleh admin setelah konfirmasi pemesanan.</li>
            </ul>
        </div>
    </div>

    {{-- Poin 3 --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-header">
            <h3>3. Pembayaran</h3>
        </div>
        <div class="card-body">
            <ul style="padding-left:18px;font-size:13px;color:var(--text);line-height:2.1;list-style:disc;">
                <li>Pembayaran dapat dilakukan via Transfer Bank Mandiri, Transfer Bank BRI, atau Tunai.</li>
                <li>Untuk pembayaran transfer, bukti pembayaran wajib diupload saat pemesanan.</li>
                <li>Bukti transfer akan diverifikasi oleh admin dalam 1x24 jam.</li>
                <li>Pembayaran tunai dilakukan langsung di lokasi saat pengambilan motor.</li>
            </ul>
        </div>
    </div>

    {{-- Poin 4 --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-header">
            <h3>4. Pembatalan</h3>
        </div>
        <div class="card-body">
            <ul style="padding-left:18px;font-size:13px;color:var(--text);line-height:2.1;list-style:disc;">
                <li>Pembatalan hanya dapat dilakukan jika status transaksi masih <strong>Pending</strong>.</li>
                <li>Transaksi yang sudah berstatus Aktif tidak dapat dibatalkan melalui aplikasi.</li>
                <li>Untuk pembatalan darurat, hubungi admin langsung via WhatsApp.</li>
            </ul>
        </div>
    </div>

    {{-- Poin 5 --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-header">
            <h3>5. Larangan</h3>
        </div>
        <div class="card-body">
            <ul style="padding-left:18px;font-size:13px;color:var(--text);line-height:2.1;list-style:disc;">
                <li>Dilarang membawa motor keluar kota tanpa izin tertulis dari pihak rental.</li>
                <li>Dilarang menggunakan motor untuk kegiatan ilegal atau balap liar.</li>
                <li>Dilarang memodifikasi atau mengubah kondisi motor tanpa seizin rental.</li>
                <li>Dilarang menyewakan kembali motor kepada pihak lain.</li>
            </ul>
        </div>
    </div>

    {{-- Pernyataan Persetujuan --}}
    <div style="background:#EEF5FB;border-radius:10px;padding:16px;
                border:1.5px solid var(--secondary);font-size:13px;color:var(--text);
                line-height:1.7;margin-bottom:20px;">
        <strong style="color:var(--primary);">Pernyataan:</strong>
        Dengan melakukan pemesanan di website ini, Anda dianggap telah membaca,
        memahami, dan menyetujui seluruh syarat dan ketentuan di atas.
    </div>

    <a href="{{ route('customer.rental.index') }}" class="btn btn-primary">
        Mulai Sewa Motor
    </a>

</div>
@endsection

