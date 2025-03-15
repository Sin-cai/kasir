<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

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
    
        $totalPenjualan = $penjualans->sum('total_harga');
    
        
       $totalKeuntungan = 0;

foreach ($penjualans as $penjualan) {
    $totalModal = 0;

    foreach ($penjualan->detailPenjualan as $detail) {
        if ($detail->produk) {
            $hargaBeli = $detail->produk->harga_beli;
            $qty = $detail->qty;

            $totalModal += $hargaBeli * $qty;
        }
    }

    
    $profitPerTransaksi = $penjualan->total_harga - $totalModal;
    $totalKeuntungan += $profitPerTransaksi;
}
    
        return view('admin.laporan.index', compact('penjualans', 'tanggalMulai', 'tanggalSelesai', 'totalPenjualan', 'totalKeuntungan'));
    }
}
