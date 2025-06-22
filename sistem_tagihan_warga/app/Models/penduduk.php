<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penduduk extends Model
{
    protected $fillable = ['no_kk', 'nama', 'alamat', 'no_hp'];
    protected $table = 'penduduks';
    public $timestamps = false;

    public function TransaksiTagihan()
    {
        return $this->hasMany(TransaksiTagihan::class);
        // hasMany(TargetModel, foreignKeyOnTarget, localKey)
    }
}
