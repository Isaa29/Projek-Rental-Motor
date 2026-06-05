<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden   = ['password', 'remember_token'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'admin_id');
    }
    public function isAdmin()    { return $this->role === 'admin'; }
    public function isCustomer() { return $this->role === 'customer'; }
}
