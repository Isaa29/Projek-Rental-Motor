<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisMotor extends Model
{
    use SoftDeletes;
    protected $table    = 'jenis_motors';
    protected $fillable = [
        'nama_jenis', 'merk', 'motor_id', 'tipe', 'harga_sewa', 'foto', 'deskripsi',
    ];

    public function motors()
    {
        return $this->hasMany(Motor::class, 'jenis_motor_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'jenis_motor_id');
    }

    public function unitTersedia()
    {
        return $this->motors()->where('status', 'tersedia')->count();
    }

    public function adaUnitTersedia()
    {
        return $this->unitTersedia() > 0;
    }

    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_sewa, 0, ',', '.');
    }

    public function getFotoUrlAttribute()
    {
        return $this->foto
            ? asset('storage/jenis/' . $this->foto)
            : null;
    }
}
