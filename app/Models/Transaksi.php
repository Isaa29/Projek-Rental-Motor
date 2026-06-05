<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id', 'jenis_motor_id','motor_id',
        'tanggal_sewa', 'tanggal_kembali', 'total_harga',
        'metode_bayar', 'bukti_bayar', 'status_bayar', 'status',
    ];

    protected $casts = [
        'tanggal_sewa'    => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisMotor()
    {
        return $this->belongsTo(JenisMotor::class, 'jenis_motor_id');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class);
    }

    public function getDurasiHariAttribute()
    {
        return $this->tanggal_sewa->diffInDays($this->tanggal_kembali);
    }

    public function getTotalFormatAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending'    => 'Menunggu',
            'aktif'      => 'Aktif',
            'selesai'    => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default      => $this->status,
        };
    }

    public function getStatusBayarLabelAttribute()
    {
        return match($this->status_bayar) {
            'menunggu' => 'Menunggu Verifikasi',
            'lunas'    => 'Lunas',
            'gagal'    => 'Gagal',
            default    => $this->status_bayar,
        };
    }

    // Label metode bayar
    public function getMetodeBayarLabelAttribute()
    {
        return match($this->metode_bayar) {
            'transfer_mandiri' => 'Transfer Bank Mandiri',
            'transfer_bri'     => 'Transfer Bank BRI',
            'tunai'            => 'Tunai',
            default            => $this->metode_bayar,
        };
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}
