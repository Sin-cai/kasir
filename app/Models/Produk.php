<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    
    protected $fillable = [
        'id_kategoris',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'barcode'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategoris');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produks');
    }
}
