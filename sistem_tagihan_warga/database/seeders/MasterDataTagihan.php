<?php

namespace Database\Seeders;

use App\Models\Tagihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataTagihan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_tagihan_seeder = [
            ['kode_tagihan' => 'TAG-AIR', 'jenis_tagihan' => 1, 'harga_tagihan' => 5000],
            ['kode_tagihan' => 'TAG-KEAMANAN', 'jenis_tagihan' => 2, 'harga_tagihan' => 15000],
            ['kode_tagihan' => 'TAG-SAMPAH', 'jenis_tagihan' => 3, 'harga_tagihan' => 20000],
        ];

        foreach ($data_tagihan_seeder as $data_input) {
            Tagihan::create($data_input);
        }
    }
}
