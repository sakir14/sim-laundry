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
        Schema::table('transaksis', function (Blueprint $table) {
            // Masukkan semua kolom yang kurang sekalian biar aman!
            
            if (!Schema::hasColumn('transaksis', 'biaya_ongkir')) {
                $table->integer('biaya_ongkir')->default(0);
            }
            if (!Schema::hasColumn('transaksis', 'total_bayar')) {
                $table->integer('total_bayar')->default(0);
            }
            if (!Schema::hasColumn('transaksis', 'status_pembayaran')) {
                $table->string('status_pembayaran')->default('belum_lunas');
            }
            if (!Schema::hasColumn('transaksis', 'status_pesanan')) {
                $table->string('status_pesanan')->default('proses');
            }
            if (!Schema::hasColumn('transaksis', 'jenis_pengambilan')) {
                $table->string('jenis_pengambilan')->default('ambil_sendiri');
            }
            if (!Schema::hasColumn('transaksis', 'alamat_pengiriman')) {
                $table->text('alamat_pengiriman')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn([
                'biaya_ongkir', 'total_bayar', 'status_pembayaran', 
                'status_pesanan', 'jenis_pengambilan', 'alamat_pengiriman'
            ]);
        });
    }
};
