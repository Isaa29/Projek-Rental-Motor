<?php

namespace Database\Seeders;

use App\Models\Motor;
use Illuminate\Database\Seeder;

class MotorSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['jenis_motor_id'=>1,'plat_nomor'=>'P 1234 AB','tahun'=>2022,'warna'=>'Hitam',  'status'=>'tersedia'],
            ['jenis_motor_id'=>1,'plat_nomor'=>'P 1235 AB','tahun'=>2023,'warna'=>'Putih',  'status'=>'tersedia'],
            ['jenis_motor_id'=>2,'plat_nomor'=>'P 2234 CD','tahun'=>2022,'warna'=>'Merah',  'status'=>'tersedia'],
            ['jenis_motor_id'=>2,'plat_nomor'=>'P 2235 CD','tahun'=>2023,'warna'=>'Biru',   'status'=>'disewa'],
            ['jenis_motor_id'=>3,'plat_nomor'=>'P 3234 EF','tahun'=>2023,'warna'=>'Silver', 'status'=>'tersedia'],
            ['jenis_motor_id'=>3,'plat_nomor'=>'P 3235 EF','tahun'=>2022,'warna'=>'Hitam',  'status'=>'tersedia'],
            ['jenis_motor_id'=>4,'plat_nomor'=>'P 4234 GH','tahun'=>2023,'warna'=>'Putih',  'status'=>'disewa'],
            ['jenis_motor_id'=>4,'plat_nomor'=>'P 4235 GH','tahun'=>2022,'warna'=>'Abu-abu','status'=>'tersedia'],
            ['jenis_motor_id'=>5,'plat_nomor'=>'P 5234 IJ','tahun'=>2023,'warna'=>'Biru',   'status'=>'tersedia'],
            ['jenis_motor_id'=>5,'plat_nomor'=>'P 5235 IJ','tahun'=>2022,'warna'=>'Hitam',  'status'=>'tersedia'],
            ['jenis_motor_id'=>6,'plat_nomor'=>'P 6234 KL','tahun'=>2023,'warna'=>'Hitam',  'status'=>'disewa'],
            ['jenis_motor_id'=>6,'plat_nomor'=>'P 6235 KL','tahun'=>2022,'warna'=>'Merah',  'status'=>'tersedia'],
            ['jenis_motor_id'=>7,'plat_nomor'=>'P 7234 MN','tahun'=>2021,'warna'=>'Hijau',  'status'=>'tersedia'],
            ['jenis_motor_id'=>8,'plat_nomor'=>'P 8234 OP','tahun'=>2022,'warna'=>'Abu-abu','status'=>'tersedia'],
            ['jenis_motor_id'=>8,'plat_nomor'=>'P 8235 OP','tahun'=>2021,'warna'=>'Biru',   'status'=>'tersedia'],
        ];

        foreach ($units as $u) {
            Motor::create($u);
        }
    }
}
