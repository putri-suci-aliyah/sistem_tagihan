<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = ['kode_tagihan', 'jenis_tagihan', 'harga_tagihan'];
    protected $table = 'tagihans';
    public $timestamps = false;

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksis')
                    ->withPivot('qty','harga_tagihan')
                    ->withTimestamps();
    }
}
