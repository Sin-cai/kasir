<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class KasirController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with(['user', 'pelanggan', 'detailPenjualan.produk'])
        ->paginate(5); // Batasi 5 data per halaman
        return view('petugas.kasir.index', compact('penjualans'));
    }

    public function create()
    {
        return view('petugas.kasir.create');
    }

    public function searchProduct(Request $request)
    {
        $products = Produk::where('nama_produk', 'like', '%' . $request->query('query') . '%')
                          ->orWhere('barcode', 'like', '%' . $request->query('query') . '%')
                          ->get();
    
        return response()->json($products);
    }

    public function storeTransaction(Request $request)
{
    DB::beginTransaction();
    try {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }

        $diskon = ($request->id_pelanggan) ? 15 : 0;
        $total_harga = $request->total_harga;
        $bayar = $request->bayar;
        $kembali = $bayar - $total_harga; // Hitung kembalian otomatis
     
        $penjualan = Penjualan::create([
            'id_users' => Auth::id(),
            'id_pelanggans' => $request->id_pelanggan,
            'diskon' => $diskon,
            'total_harga' => $total_harga,
            'bayar' => $bayar,
            'kembali' => $kembali,
        ]);

        foreach ($request->items as $item) {
            DetailPenjualan::create([
                'id_penjualans' => $penjualan->id,
                'id_produks' => $item['id'],
                'harga_jual' => $item['harga'],
                'qty' => $item['qty'],
                'sub_total' => $item['harga'] * $item['qty'],
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'redirect' => route('print2', ['id' => $penjualan->id]) // Redirect ke halaman cetak nota
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}



    public function searchMember(Request $request)
{
    $members = Pelanggan::where('hp', 'like', '%' . $request->query('query') . '%')->get();
    return response()->json($members);
}


    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return redirect()->route('kasir.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids'); // Ambil ID yang dikirim dari AJAX

    if (!empty($ids)) {
        Penjualan::whereIn('id', $ids)->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    return response()->json(['error' => 'Tidak ada data yang dipilih'], 400);
}

    public function edit($id)
    {
        $penjualan = Penjualan::with(['detailPenjualan.produk', 'pelanggan'])->findOrFail($id);
        $produk = Produk::all();
        $pelanggans = Pelanggan::all();
        return view('admin.penjualan.edit', compact('penjualan', 'produk', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $penjualan = Penjualan::findOrFail($id);
            $penjualan->update([
                'id_pelanggans' => $request->id_pelanggan,
                'diskon' => $request->diskon,
                'total_harga' => $request->total_harga,
            ]);

            DetailPenjualan::where('id_penjualans', $id)->delete();
            foreach ($request->items as $item) {
                DetailPenjualan::create([
                    'id_penjualans' => $id,
                    'id_produks' => $item['id'],
                    'harga_jual' => $item['harga'],
                    'qty' => $item['qty'],
                    'sub_total' => $item['harga'] * $item['qty'],
                ]);
            }

            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('penjualan.index')->with('error', 'Gagal memperbarui data penjualan.');
        }
    }

    public function printtPage($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk', 'user', 'pelanggan')->findOrFail($id);
        return view('print2', compact('penjualan'));
    }
    
    public function cetakNota($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk', 'user', 'pelanggan')->findOrFail($id);
    
        // $pdf = PDF::loadView('nota', compact('penjualan'))->setPaper([0, 0, 226.77, 600]); // Ukuran kecil seperti nota
        // return $pdf->stream("nota_penjualan_$id.pdf"); // Langsung tampilkan PDF

        return view('nota', compact('penjualan'));
    }

    public function cetakInvoice($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk', 'user', 'pelanggan')->findOrFail($id);
    
       
        return view('invoice', compact('penjualan'));
    }

    public function cetakInvoicePDF($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk', 'user', 'pelanggan')->findOrFail($id);
    
        $pdf = Pdf::loadView('invoicepdf', compact('penjualan'))
                  ->setPaper('A4', 'portrait'); // Ukuran A4, orientasi potrait
    
        return $pdf->stream("invoice_$id.pdf"); // Langsung tampilkan PDF
    }

}
