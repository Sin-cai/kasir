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
        $penjualanId = DB::table('penjualans')->insertGetId([
            'id_users' => 1, // Pastikan user dengan ID 1 ada
            'id_pelanggans' => 1, // Pastikan pelanggan dengan ID 1 ada
            'diskon' => 15.00,
            'total_harga' => 8500.00,
            'bayar' => 10000.00,
            'kembali' => 1500.00,    
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert data ke tabel detail_penjualans
        DB::table('detail_penjualans')->insert([
            [
                'id_penjualans' => $penjualanId,
                'id_produks' => 1, // Pastikan produk dengan ID 1 ada
                'harga_jual' => 10000.00,
                'qty' => 1,
                'sub_total' => 10000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
