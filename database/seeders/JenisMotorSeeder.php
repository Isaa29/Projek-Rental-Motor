<?php

namespace Database\Seeders;

use App\Models\JenisMotor;
use Illuminate\Database\Seeder;

class JenisMotorSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_jenis'=>'Honda Beat Street',  'merk'=>'Honda',    'tipe'=>'Matic',  'harga_sewa'=>80000,  'deskripsi'=>'Motor matic ekonomis, irit dan gesit untuk harian.'],
            ['nama_jenis'=>'Honda Scoopy',        'merk'=>'Honda',    'tipe'=>'Matic',  'harga_sewa'=>90000,  'deskripsi'=>'Motor retro stylish, populer di kalangan anak muda.'],
            ['nama_jenis'=>'Honda Vario 160',     'merk'=>'Honda',    'tipe'=>'Matic',  'harga_sewa'=>110000, 'deskripsi'=>'Motor matic 160cc bertenaga, cocok untuk perjalanan jauh.'],
            ['nama_jenis'=>'Honda PCX 160',       'merk'=>'Honda',    'tipe'=>'Matic',  'harga_sewa'=>140000, 'deskripsi'=>'Motor premium dengan bagasi luas dan suspensi nyaman.'],
            ['nama_jenis'=>'Yamaha NMAX 155',     'merk'=>'Yamaha',   'tipe'=>'Matic',  'harga_sewa'=>150000, 'deskripsi'=>'Motor matic premium Blue Core, nyaman untuk touring.'],
            ['nama_jenis'=>'Yamaha Aerox 155',    'merk'=>'Yamaha',   'tipe'=>'Matic',  'harga_sewa'=>130000, 'deskripsi'=>'Motor sport matic agresif dengan performa tinggi.'],
            ['nama_jenis'=>'Kawasaki KLX 150',    'merk'=>'Kawasaki', 'tipe'=>'Manual', 'harga_sewa'=>160000, 'deskripsi'=>'Motor trail tangguh untuk off-road dan medan berat.'],
            ['nama_jenis'=>'Suzuki Nex II',       'merk'=>'Suzuki',   'tipe'=>'Matic',  'harga_sewa'=>75000,  'deskripsi'=>'Motor paling irit, pilihan hemat untuk perjalanan sehari-hari.'],
        ];

        foreach ($data as $d) {
            JenisMotor::create($d);
        }
    }
}
