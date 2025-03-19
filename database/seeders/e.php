<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class e extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanggal = Carbon::create(2025, 2, 25, 0, 0, 0); // 25 Februari 2025

        $penjualanId = DB::table('penjualans')->insertGetId([
            'id_users' => 1, // Pastikan user dengan ID 1 ada
            'id_pelanggans' => 1, // Pastikan pelanggan dengan ID 1 ada
            'diskon' => 15.00,
            'total_harga' => 8075.00,
            'bayar' => 10000.00,
            'kembali' => 1925.00,    
            'created_at' => $tanggal,
            'updated_at' => $tanggal,
        ]);

        // Insert data ke tabel detail_penjualans
        DB::table('detail_penjualans')->insert([
            [
                'id_penjualans' => $penjualanId,
                'id_produks' => 1, // Pastikan produk dengan ID 1 ada
                'harga_jual' => 10000.00,
                'qty' => 1,
                'diskon_produk' => 5.00,
                'sub_total' => 9500.00,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ],
        ]);
    }
}
