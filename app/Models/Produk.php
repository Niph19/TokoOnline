<?php

namespace App\Models;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

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
