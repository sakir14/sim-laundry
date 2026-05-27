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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->cascadeOnDelete();
            $table->foreignId('layanan_id')->constrained('layanans');
            $table->decimal('jumlah', 8, 2);
            $table->integer('harga');
            $table->string('satuan', 20);
            $table->integer('subtotal');
            $table->timestamps();
        });

        $transaksis = DB::table('transaksis')->orderBy('id')->get();

        foreach ($transaksis as $transaksi) {
            if (empty($transaksi->layanan_id)) {
                continue;
            }

            $layanan = DB::table('layanans')->where('id', $transaksi->layanan_id)->first();

            if (!$layanan) {
                continue;
            }

            $jumlah = (float) ($transaksi->berat ?? 0);
            $harga = (int) $layanan->harga;

            DB::table('transaksi_details')->insert([
                'transaksi_id' => $transaksi->id,
                'layanan_id' => $layanan->id,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'satuan' => $layanan->satuan,
                'subtotal' => (int) round($harga * $jumlah),
                'created_at' => $transaksi->created_at ?? now(),
                'updated_at' => $transaksi->updated_at ?? now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
