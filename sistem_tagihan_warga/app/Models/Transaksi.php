<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode_transaksi', 'warga_penduduks_id', 'status_pembayaran'];
    protected $table = 'transaksis';
    public $timestamps = false;

    protected $primaryKey = 'id';

    public function warga_penduduks()
    {
        return $this->belongsTo(WargaPenduduk::class);
    }

    public function tagihan()
    {
        return $this->belongsToMany(Tagihan::class, 'detail_transaksis')
                    ->withPivot('qty','harga_tagihan')
                    ->withTimestamps();
    }
}
