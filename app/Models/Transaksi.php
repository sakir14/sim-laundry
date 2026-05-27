<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public const JENIS_AMBIL_SENDIRI = 'ambil_sendiri';
    public const JENIS_ANTAR = 'antar';
    public const JENIS_ANTAR_JEMPUT = 'antar_jemput';

    // 1. Buka gerbang untuk semua kolom ini agar bisa disimpan
    protected $fillable = [
        'no_nota',
        //'tanggal_masuk',
        'pelanggan_id',
        'layanan_id',
        'user_id',
        'berat',
        'biaya_ongkir',
        'total_bayar',
        'status_pembayaran',
        'status_pesanan',
        'jenis_pengambilan',
        'alamat_pengiriman',
    ];

    // 2. Relasi ke tabel Pelanggan (Agar bisa memanggil nama pelanggan)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // 3. Relasi ke tabel Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function getRincianLayananAttribute()
    {
        $details = $this->relationLoaded('details')
            ? $this->details
            : $this->details()->with('layanan')->get();

        if ($details->isNotEmpty()) {
            return $details;
        }

        if (!$this->layanan) {
            return collect();
        }

        $detail = new TransaksiDetail([
            'layanan_id' => $this->layanan_id,
            'jumlah' => $this->berat,
            'harga' => $this->layanan->harga,
            'satuan' => $this->layanan->satuan,
            'subtotal' => (int) round($this->layanan->harga * $this->berat),
        ]);
        $detail->setRelation('layanan', $this->layanan);

        return collect([$detail]);
    }

    public function getButuhKurirAttribute(): bool
    {
        return in_array($this->jenis_pengambilan, [
            self::JENIS_ANTAR,
            self::JENIS_ANTAR_JEMPUT,
        ], true);
    }

    public function getJenisPengambilanLabelAttribute(): string
    {
        return match ($this->jenis_pengambilan) {
            self::JENIS_ANTAR => 'Diantar oleh Kurir',
            self::JENIS_ANTAR_JEMPUT => 'Antar & Jemput oleh Kurir',
            default => 'Pelanggan Ambil Sendiri',
        };
    }

    // 4. Relasi ke tabel User (Untuk mencatat Kasir yang melayani)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
