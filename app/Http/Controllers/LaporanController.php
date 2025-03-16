<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
    
        if (!$tanggalMulai || !$tanggalSelesai) {
            $tanggalMulai = now()->startOfDay()->toDateTimeString();
            $tanggalSelesai = now()->endOfDay()->toDateTimeString();
        }
    
        $penjualans = Penjualan::with(['user', 'pelanggan', 'detailPenjualan.produk'])
            ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Hitung Total Penjualan
        $totalPenjualan = $penjualans->sum('total_harga');
    
        // Hitung Total Keuntungan (Profit)
        $totalKeuntungan = 0;
        $totalBarangTerjual = 0; // Variabel untuk menyimpan total barang terjual

        foreach ($penjualans as $penjualan) {
            $totalModal = 0; // Simpan total modal per transaksi
    
            foreach ($penjualan->detailPenjualan as $detail) {
                if ($detail->produk) {
                    $hargaBeli = $detail->produk->harga_beli;
                    $qty = $detail->qty;
    
                    // Hitung total modal per produk
                    $totalModal += $hargaBeli * $qty;
                    
                    // Hitung total barang terjual
                    $totalBarangTerjual += $qty;
                }
            }
    
            // Hitung profit per transaksi
            $profitPerTransaksi = $penjualan->total_harga - $totalModal;
            $totalKeuntungan += $profitPerTransaksi;
        }
    
        return view('admin.laporan.index', compact('penjualans', 'tanggalMulai', 'tanggalSelesai', 'totalPenjualan', 'totalKeuntungan', 'totalBarangTerjual'));
    }

}
