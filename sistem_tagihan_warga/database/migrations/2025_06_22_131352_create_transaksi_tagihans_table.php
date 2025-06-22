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
        Schema::create('transaksi_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('no_kk');
            $table->string('status_pembayaran')->default("1");
            $table->timestamps();
            $table->foreign('no_kk')->references('no_kk')->on('penduduks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_tagihans');
    }
};
