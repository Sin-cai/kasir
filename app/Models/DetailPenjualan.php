<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'id_penjualans',
        'id_produks',
        'harga_jual',
        'qty',
        'diskon_produk',
        'sub_total',
        'tanggal_penjualan'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualans');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produks');
    }
}
