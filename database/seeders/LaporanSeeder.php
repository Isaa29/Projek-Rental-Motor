<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        Laporan::create(['admin_id'=>1,'transaksi_id'=>1,'keterangan'=>'Selesai tepat waktu, motor kembali bersih.']);
        Laporan::create(['admin_id'=>1,'transaksi_id'=>2,'keterangan'=>'Selesai tepat waktu, motor kembali dengan sedikit goresan.']);
        Laporan::create(['admin_id'=>1,'transaksi_id'=>5,'keterangan'=>'Motor dikembalikan tanpa kerusakan.']);
    }
}
