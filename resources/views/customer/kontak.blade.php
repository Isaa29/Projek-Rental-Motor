@extends('layouts.customer')
@section('title','Kontak - Rental Motor Jaya')

@section('content')
<div class="page-wrap" style="max-width:900px;">

    <div class="page-hdr">
        <h1>Hubungi Kami</h1>
        <p>Ada pertanyaan? Tim kami siap membantu Anda</p>
    </div>

    {{-- Grid Info Kontak --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px;">

        {{-- WhatsApp --}}
        <div class="card" style="text-align:center;padding:24px;">
            <div style="font-size:32px;margin-bottom:10px;color:var(--primary);">W</div>
            <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 6px;">
                WhatsApp
            </h3>
            <p style="font-size:12px;color:var(--text);margin:0 0 12px;">
                Respon tercepat via chat
            </p>
            <a href="https://wa.me/6281234567890" target="_blank"
               style="display:inline-block;background:#25D366;color:#fff;
                      padding:8px 18px;border-radius:8px;font-size:12px;font-weight:600;
                      transition:background .2s;">
                Chat Sekarang
            </a>
        </div>

        {{-- Alamat --}}
        <div class="card" style="text-align:center;padding:24px;">
            <div style="font-size:32px;margin-bottom:10px;color:var(--primary);">L</div>
            <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 6px;">
                Lokasi
            </h3>
            <p style="font-size:12px;color:var(--text);margin:0 0 3px;">
                Jl. Gajah Mada No.13
            </p>
            <p style="font-size:12px;color:var(--text);margin:0;">
                Kota Jember, Jawa Timur
            </p>
        </div>

        {{-- Jam Operasional --}}
        <div class="card" style="text-align:center;padding:24px;">
            <div style="font-size:32px;margin-bottom:10px;color:var(--primary);">J</div>
            <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 6px;">
                Jam Buka
            </h3>
            <p style="font-size:12px;color:var(--text);margin:0 0 3px;">
                Senin - Sabtu: 08.00 - 20.00
            </p>
            <p style="font-size:12px;color:var(--text);margin:0;">
                Minggu: 09.00 - 17.00
            </p>
        </div>

    </div>

    {{-- Email --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-body"
             style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
            <div style="flex:1;">
                <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 4px;">
                    Email
                </h3>
                <p style="font-size:13px;color:var(--text);margin:0;">
                    Kirim pertanyaan ke
                    <a href="mailto:jayamotor@gmail.com"
                       style="color:var(--primary);font-weight:600;">
                        jayamotor@gmail.com
                    </a>
                </p>
                <p style="font-size:11px;color:#aaa;margin:3px 0 0;">
                    Kami akan membalas dalam 1x24 jam pada hari kerja.
                </p>
            </div>
        </div>
    </div>

    {{-- Telepon --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-body"
             style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
            <div style="flex:1;">
                <h3 style="font-size:14px;font-weight:700;color:var(--primary);margin:0 0 4px;">
                    Telepon
                </h3>
                <p style="font-size:13px;color:var(--text);margin:0;">
                    <a href="tel:081234567890"
                       style="color:var(--primary);font-weight:600;">
                        081234567890
                    </a>
                </p>
                <p style="font-size:11px;color:#aaa;margin:3px 0 0;">
                    Tersedia selama jam operasional.
                </p>
            </div>
        </div>
    </div>

    {{-- CTA WA --}}
    <div class="card"
         style="background:linear-gradient(135deg,var(--primary),#3b6790);
                border:none;padding:22px;
                display:flex;align-items:center;justify-content:space-between;
                flex-wrap:wrap;gap:14px;">
        <div>
            <h3 style="font-size:16px;font-weight:700;color:#fff;margin:0 0 4px;">
                Butuh Bantuan Segera?
            </h3>
            <p style="font-size:13px;color:rgba(255,255,255,.8);margin:0;">
                Admin kami aktif setiap hari selama jam operasional via WhatsApp.
            </p>
        </div>
        <a href="https://wa.me/6281234567890" target="_blank"
           style="background:#fbbf24;color:#78350f;padding:10px 20px;
                  border-radius:8px;font-size:13px;font-weight:700;white-space:nowrap;">
            Hubungi via WhatsApp
        </a>
    </div>

</div>

<style>
    @media (max-width:768px) {
        .page-wrap div[style*="repeat(3,1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection
