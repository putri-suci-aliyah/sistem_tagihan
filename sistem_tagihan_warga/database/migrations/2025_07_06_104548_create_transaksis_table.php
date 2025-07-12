<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->foreignId('warga_penduduks_id')->constrained('warga_penduduks')->onDelete('cascade');
            $table->string('status_pembayaran')->default("Belum Lunas");
            $table->string('periode_bulan');
            $table->integer('periode_tahun');
            $table->unique(['warga_penduduks_id', 'periode_bulan', 'periode_tahun'], 'unique_warga_periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
