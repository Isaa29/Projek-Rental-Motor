<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'user_id'=>2,'jenis_motor_id'=>1,
                'tanggal_sewa'=>'2025-05-01','tanggal_kembali'=>'2025-05-03',
                'total_harga'=>160000,'metode_bayar'=>'tunai',
                'status_bayar'=>'lunas','status'=>'selesai',
            ],
            [
                'user_id'=>3,'jenis_motor_id'=>5,
                'tanggal_sewa'=>'2025-05-05','tanggal_kembali'=>'2025-05-07',
                'total_harga'=>300000,'metode_bayar'=>'transfer_mandiri',
                'bukti_bayar'=>null,'status_bayar'=>'lunas','status'=>'selesai',
            ],
            [
                'user_id'=>4,'jenis_motor_id'=>6,
                'tanggal_sewa'=>'2025-05-10','tanggal_kembali'=>'2025-05-12',
                'total_harga'=>260000,'metode_bayar'=>'transfer_bri',
                'bukti_bayar'=>null,'status_bayar'=>'menunggu','status'=>'aktif',
            ],
            [
                'user_id'=>2,'jenis_motor_id'=>4,
                'tanggal_sewa'=>'2025-05-15','tanggal_kembali'=>'2025-05-17',
                'total_harga'=>280000,'metode_bayar'=>'transfer_mandiri',
                'bukti_bayar'=>null,'status_bayar'=>'menunggu','status'=>'aktif',
            ],
            [
                'user_id'=>3,'jenis_motor_id'=>2,
                'tanggal_sewa'=>'2025-04-20','tanggal_kembali'=>'2025-04-22',
                'total_harga'=>180000,'metode_bayar'=>'tunai',
                'status_bayar'=>'lunas','status'=>'selesai',
            ],
        ];

        foreach ($data as $d) {
            Transaksi::create($d);
        }
    }
}
