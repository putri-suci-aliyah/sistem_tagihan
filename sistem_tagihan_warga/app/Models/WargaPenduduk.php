<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaPenduduk extends Model
{

    protected $fillable = ['no_kk', 'nama', 'no_hp', 'alamat'];
    protected $table = 'warga_penduduks';
    public $timestamps = false;

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

}
