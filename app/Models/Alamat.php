<?php

namespace App\Models;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $fillable = [
        'alamat',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
