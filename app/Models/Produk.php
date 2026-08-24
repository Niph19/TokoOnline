<?php

namespace App\Models;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'image',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
