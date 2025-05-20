<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $fillable = ['no_kk', 'nama', 'alamat', 'no_hp'];
    protected $table = 'warga';
}
