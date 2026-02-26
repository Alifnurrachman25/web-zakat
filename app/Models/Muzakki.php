<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Muzakki extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',       // harus sama dengan kolom database
        'perumahan',
        'rt',
        'blok',
        'phone',
        'user_id'
    ];
}
