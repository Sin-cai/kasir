<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class o extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('pelanggans')->insert([
            ['nama' => 'nga', 'alamat' => 'Jl. Pelanggan No. 1', 'hp' => '081234567892', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'tul', 'alamat' => 'Jl. Pelanggan No. 2', 'hp' => '081234567893', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
