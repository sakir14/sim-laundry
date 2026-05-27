<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // INI YANG PALING PENTING AGAR DATA BISA DISIMPAN:
    protected $fillable = [
        'nama_pelanggan', 
        'no_hp', 
        'alamat'
    ];

    // Relasi (Opsional untuk saat ini, tapi wajib nanti)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}