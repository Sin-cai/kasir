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
            ['id_kategoris' => 1, 'nama_produk' => 'Cocacola', 'harga_beli' => 5000000, 'harga_jual' => 6000000, 'stok' => 10, 'barcode' => '1234567890', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategoris' => 2, 'nama_produk' => 'Japota', 'harga_beli' => 50000, 'harga_jual' => 75000, 'stok' => 50, 'barcode' => '0987654321', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
