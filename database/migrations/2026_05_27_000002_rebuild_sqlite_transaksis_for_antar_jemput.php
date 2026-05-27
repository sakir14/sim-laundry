<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            return;
        }

        Schema::disableForeignKeyConstraints();

        Schema::create('transaksis_new', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->float('berat')->default(0);
            $table->foreignId('pelanggan_id')->constrained('pelanggans');
            $table->foreignId('layanan_id')->constrained('layanans');
            $table->enum('jenis_pengambilan', ['ambil_sendiri', 'antar', 'antar_jemput']);
            $table->text('alamat_pengiriman')->nullable();
            $table->integer('biaya_ongkir')->nullable();
            $table->integer('total_bayar');
            $table->enum('status_cucian', ['Baru', 'Dicuci', 'Disetrika', 'Selesai', 'Sedang Diantar', 'Diterima Pelanggan'])->default('Baru');
            $table->enum('status_bayar', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->string('status_pembayaran')->default('belum_lunas');
            $table->string('status_pesanan')->default('proses');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO transaksis_new (
                id, no_nota, user_id, berat, pelanggan_id, layanan_id,
                jenis_pengambilan, alamat_pengiriman, biaya_ongkir, total_bayar,
                status_cucian, status_bayar, status_pembayaran, status_pesanan,
                created_at, updated_at
            )
            SELECT
                id, no_nota, user_id, berat, pelanggan_id, layanan_id,
                jenis_pengambilan, alamat_pengiriman, biaya_ongkir, total_bayar,
                status_cucian, status_bayar, status_pembayaran, status_pesanan,
                created_at, updated_at
            FROM transaksis
        ");

        Schema::drop('transaksis');
        Schema::rename('transaksis_new', 'transaksis');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            return;
        }

        DB::table('transaksis')
            ->where('jenis_pengambilan', 'antar_jemput')
            ->update(['jenis_pengambilan' => 'antar']);

        Schema::disableForeignKeyConstraints();

        Schema::create('transaksis_new', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->float('berat')->default(0);
            $table->foreignId('pelanggan_id')->constrained('pelanggans');
            $table->foreignId('layanan_id')->constrained('layanans');
            $table->enum('jenis_pengambilan', ['ambil_sendiri', 'antar']);
            $table->text('alamat_pengiriman')->nullable();
            $table->integer('biaya_ongkir')->nullable();
            $table->integer('total_bayar');
            $table->enum('status_cucian', ['Baru', 'Dicuci', 'Disetrika', 'Selesai', 'Sedang Diantar', 'Diterima Pelanggan'])->default('Baru');
            $table->enum('status_bayar', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->string('status_pembayaran')->default('belum_lunas');
            $table->string('status_pesanan')->default('proses');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO transaksis_new (
                id, no_nota, user_id, berat, pelanggan_id, layanan_id,
                jenis_pengambilan, alamat_pengiriman, biaya_ongkir, total_bayar,
                status_cucian, status_bayar, status_pembayaran, status_pesanan,
                created_at, updated_at
            )
            SELECT
                id, no_nota, user_id, berat, pelanggan_id, layanan_id,
                jenis_pengambilan, alamat_pengiriman, biaya_ongkir, total_bayar,
                status_cucian, status_bayar, status_pembayaran, status_pesanan,
                created_at, updated_at
            FROM transaksis
        ");

        Schema::drop('transaksis');
        Schema::rename('transaksis_new', 'transaksis');

        Schema::enableForeignKeyConstraints();
    }
};
