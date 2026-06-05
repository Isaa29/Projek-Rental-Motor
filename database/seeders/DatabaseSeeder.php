<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            JenisMotorSeeder::class,
            MotorSeeder::class,    
            TransaksiSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
