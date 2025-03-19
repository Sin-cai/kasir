<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exports\LaporanPenjualanExport;

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

    public function cetakLaporanPDF(Request $request)
    {
        $tanggalMulai = $request->query('tanggal_mulai');
        $tanggalSelesai = $request->query('tanggal_selesai');
    
        // Jika tidak ada tanggal yang dipilih, gunakan tanggal hari ini
        if (!$tanggalMulai || !$tanggalSelesai) {
            $tanggalMulai = now()->toDateString(); // Hari ini
            $tanggalSelesai = now()->toDateString(); // Hari ini
        }
    
        $penjualans = Penjualan::with(['user', 'pelanggan', 'detailPenjualan.produk'])
            ->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        $totalPenjualan = $penjualans->sum('total_harga');
        $totalKeuntungan = 0;
    
        foreach ($penjualans as $penjualan) {
            $totalModal = 0;
            foreach ($penjualan->detailPenjualan as $detail) {
                if ($detail->produk) {
                    $totalModal += $detail->produk->harga_beli * $detail->qty;
                }
            }
            $totalKeuntungan += $penjualan->total_harga - $totalModal;
        }
    
        $pdf = Pdf::loadView('laporanpdf', compact('penjualans', 'tanggalMulai', 'tanggalSelesai', 'totalPenjualan', 'totalKeuntungan'))
                  ->setPaper('A4', 'portrait');
    
        return $pdf->stream("laporan_penjualan_{$tanggalMulai}_{$tanggalSelesai}.pdf");
    }

    public function export(Request $request)
{
    $startDate = $request->input('tanggal_mulai');
    $endDate = $request->input('tanggal_selesai');

    return Excel::download(new LaporanPenjualanExport($startDate, $endDate), 'laporan_penjualan.xlsx');
}
    

}
