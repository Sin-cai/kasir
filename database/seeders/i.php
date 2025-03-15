<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class i extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            ['nama_kategori' => 'minuman', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'camilan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
