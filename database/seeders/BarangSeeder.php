<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'kategori_id' => 1,
                'supplier_id' => 1,
                'nama_barang' => 'Selang Hidrolis 1 Inch',
                'stok' => 100,
                'harga_awal' => 50000
            ],
            [
                'kategori_id' => 2,
                'supplier_id' => 2,
                'nama_barang' => 'Selang Industri 2 Inch',
                'stok' => 80,
                'harga_awal' => 75000
            ],
            [
                'kategori_id' => 4,
                'supplier_id' => 1,
                'nama_barang' => 'Karet Baku Selang',
                'stok' => 200,
                'harga_awal' => 30000
            ]
        ]);
    }
}
