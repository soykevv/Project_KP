<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('supplier')->insert([
            [
                'nama_supplier' => 'PT Maju Jaya',
                'alamat' => 'Surabaya',
                'no_telp' => '081234567890'
            ],
            [
                'nama_supplier' => 'CV Sejahtera',
                'alamat' => 'Sidoarjo',
                'no_telp' => '089876543210'
            ]
        ]);
    }
}
