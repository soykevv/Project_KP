<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('user')
                  ->onDelete('cascade');

            $table->string('nomor_nota')->unique();
            $table->enum('jenis_transaksi', ['penjualan', 'pembelian']);

            $table->date('tanggal');

            $table->double('total_harga');
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas']);
            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
