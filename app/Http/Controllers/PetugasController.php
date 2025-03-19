<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Pelanggan;

class PetugasController extends Controller
{
    function index()
    {
         
        $totalSales = Penjualan::sum('total_harga');

        
        $totalTransactions = Penjualan::count();

     
        $totalProducts = Produk::count();

       
        $totalCustomers = Pelanggan::count();

        return view('petugas.dashboard', compact('totalSales', 'totalTransactions', 'totalProducts', 'totalCustomers'));
    }
}
