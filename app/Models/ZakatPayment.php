<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'muzakki_id',
        'zakat_type_id',
        'rice_type_id',
        'nama_muzakki',
        'perumahan_id',
        'rt_id',
        'blok',
        'phone',
        'jumlah_jiwa',
        'metode_pembayaran',
        'bayar',
        'infaq',
    ];

    // Relasi ke Muzakki
    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class);
    }

    // Relasi ke ZakatType
    public function zakatType()
    {
        return $this->belongsTo(ZakatType::class);
    }

    // Relasi ke RiceType
    public function riceType()
    {
        return $this->belongsTo(RiceType::class);
    }

    // Relasi ke Perumahan
    public function perumahan()
    {
        return $this->belongsTo(Perumahan::class);
    }

    // Relasi ke RT
    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }
}
