<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    
    protected $fillable = [
        'id_users',
        'id_pelanggans',
        'diskon',
        'total_harga',
        'bayar',
        'total_harga',
        'kembali',
        'tanggal_penjualan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggans');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualans');
    }
}
