<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name'=>'Admin Jaya',    'email'=>'admin@gmail.com',    'password'=>Hash::make('password'), 'role'=>'admin']);
        User::create(['name'=>'Budi Santoso',  'email'=>'customer@gmail.com', 'password'=>Hash::make('password'), 'role'=>'customer']);
        User::create(['name'=>'Nafisah Putri', 'email'=>'nafisah@gmail.com',  'password'=>Hash::make('password'), 'role'=>'customer']);
        User::create(['name'=>'Andi Wijaya',   'email'=>'andi@gmail.com',     'password'=>Hash::make('password'), 'role'=>'customer']);
    }
}
