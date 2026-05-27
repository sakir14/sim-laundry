<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('no_nota')->unique();
        $table->foreignId('user_id')->constrained('users'); // Relasi ke Kasir
        $table->foreignId('pelanggan_id')->constrained('pelanggans'); // Relasi ke Pelanggan
        $table->foreignId('layanan_id')->constrained('layanans'); // Relasi ke Layanan
        $table->enum('jenis_pengambilan', ['ambil_sendiri', 'antar']);
        $table->text('alamat_pengiriman')->nullable(); // Boleh kosong jika ambil sendiri
        $table->integer('biaya_ongkir')->nullable(); // Boleh kosong jika ambil sendiri
        $table->integer('total_bayar');
        $table->enum('status_cucian', ['Baru', 'Dicuci', 'Disetrika', 'Selesai', 'Sedang Diantar', 'Diterima Pelanggan'])->default('Baru');
        $table->enum('status_bayar', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
        $table->timestamps(); // Otomatis mencatat tgl_masuk (created_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
