<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'nama' => 'Admin Gudang',
                'username' => 'gudang',
                'password' => Hash::make('123456'),
                'role' => 'gudang'
            ],
            [
                'nama' => 'Admin Sales',
                'username' => 'sales',
                'password' => Hash::make('123456'),
                'role' => 'sales'
            ]
        ]);
    }
}
