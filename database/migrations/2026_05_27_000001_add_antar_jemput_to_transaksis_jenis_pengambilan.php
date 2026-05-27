<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE transaksis MODIFY jenis_pengambilan ENUM('ambil_sendiri', 'antar', 'antar_jemput') NOT NULL DEFAULT 'ambil_sendiri'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::table('transaksis')
                ->where('jenis_pengambilan', 'antar_jemput')
                ->update(['jenis_pengambilan' => 'antar']);

            DB::statement("ALTER TABLE transaksis MODIFY jenis_pengambilan ENUM('ambil_sendiri', 'antar') NOT NULL DEFAULT 'ambil_sendiri'");
        }
    }
};
