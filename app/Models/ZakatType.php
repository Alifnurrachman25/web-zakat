<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZakatType extends Model
{
    use HasFactory;

    // Tambahkan ini:
    protected $fillable = ['name'];
}
