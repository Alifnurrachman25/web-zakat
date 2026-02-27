<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
    protected $fillable = [
        'tanggal',
        'pemasukan_manual',
        'pemasukan_dari_zakat',
        'total_pemasukan',
        'imam',
        'kultum',
        'bilal',
        'user_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
