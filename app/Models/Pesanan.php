<?php

namespace App\Models;

use App\Models\Alamat;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'total_harga',
        'tipe',
        'bukti_pembayaran',
        'kuantitas',
        'status',
        'user_id',
        'produk_id',
        'alamat_id',
    ];

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }


    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
