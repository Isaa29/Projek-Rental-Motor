<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['admin_id', 'transaksi_id', 'keterangan'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
