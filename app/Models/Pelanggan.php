<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'hp'
    ];
    
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'id_pelanggans');
    }   
}
