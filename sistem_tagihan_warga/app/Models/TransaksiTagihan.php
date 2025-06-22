<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTagihan extends Model
{
    protected $fillable = ['kode_transaksi', 'no_kk', 'status_pembayaran'];
    protected $table = 'transaksi_tagihans';
    public $timestamps = false;
    public function penduduk()
    {
        return $this->belongsTo(penduduk::class);
    }
}
