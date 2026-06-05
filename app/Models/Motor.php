<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'jenis_motor_id',
        'plat_nomor',
        'tahun',
        'warna',
        'status',
        'catatan',
    ];

    public function jenisMotor()
    {
        return $this->belongsTo(JenisMotor::class, 'jenis_motor_id');
    }
}
