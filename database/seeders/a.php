<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class a extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            ['id_kategoris' => 1, 'nama_produk' => 'Cocacola', 'harga_beli' => 1000, 'harga_jual' => 10000, 'stok' => 100, 'barcode' => '111111', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategoris' => 2, 'nama_produk' => 'Japota', 'harga_beli' => 1000, 'harga_jual' => 10000, 'stok' => 100, 'barcode' => '22222', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
