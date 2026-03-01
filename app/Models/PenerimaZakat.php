<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaZakat extends Model
{
    protected $table = 'penerima_zakat';

    protected $fillable = [
        'name',
        'perumahan',
        'blok',
        'rt',
        'kategori',
    ];
}
