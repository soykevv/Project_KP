<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'user_id' => 2,
                'nomor_nota' => 'TRX-001',
                'jenis_transaksi' => 'penjualan',
                'tanggal' => now(),
                'total_harga' => 150000,
                'status_pembayaran' => 'lunas',
                'bukti_pembayaran' => 'bukti1.jpg'
            ],
            [
                'user_id' => 2,
                'nomor_nota' => 'TRX-002',
                'jenis_transaksi' => 'penjualan',
                'tanggal' => now(),
                'total_harga' => 75000,
                'status_pembayaran' => 'belum_lunas',
                'bukti_pembayaran' => null
            ]
        ]);
    }
}
