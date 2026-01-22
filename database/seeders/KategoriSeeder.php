<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Selang Hidrolis'],
            ['nama_kategori' => 'Selang Industri'],
            ['nama_kategori' => 'Fitting / Connector'],
            ['nama_kategori' => 'Bahan Baku Selang'],
        ]);
    }
}
