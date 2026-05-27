<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_layanan', 'harga', 'satuan'];

    // Relasi: 1 Layanan bisa ada di banyak Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
