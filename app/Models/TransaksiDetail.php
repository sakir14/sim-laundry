<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'layanan_id',
        'jumlah',
        'harga',
        'satuan',
        'subtotal',
    ];

    protected $casts = [
        'jumlah' => 'float',
        'harga' => 'integer',
        'subtotal' => 'integer',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function getJumlahLabelAttribute(): string
    {
        $jumlah = number_format((float) $this->jumlah, 2, ',', '.');

        return rtrim(rtrim($jumlah, '0'), ',');
    }

    public function getSatuanLabelAttribute(): string
    {
        return strtoupper($this->satuan);
    }
}
