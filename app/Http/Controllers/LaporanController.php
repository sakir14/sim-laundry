<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default: Menampilkan data dari tanggal 1 bulan ini sampai akhir bulan ini
        $tgl_awal = $request->input('tgl_awal', Carbon::now()->startOfMonth()->toDateString());
        $tgl_akhir = $request->input('tgl_akhir', Carbon::now()->endOfMonth()->toDateString());

        // Ambil data transaksi yang LUNAS di rentang tanggal tersebut
        $transaksis = Transaksi::whereBetween('created_at', [$tgl_awal . ' 00:00:00', $tgl_akhir . ' 23:59:59'])
                               ->where('status_pembayaran', 'lunas')
                               ->latest()
                               ->get();

        // Hitung total uangnya
        $total_pendapatan = $transaksis->sum('total_bayar');

        return view('laporan.index', compact('transaksis', 'tgl_awal', 'tgl_akhir', 'total_pendapatan'));
    }
}