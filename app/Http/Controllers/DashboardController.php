<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use Carbon\Carbon; // Untuk memanipulasi tanggal
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data untuk Kartu Ringkasan (Widget)
        $total_pelanggan = Pelanggan::count();
        $cucian_proses = Transaksi::where('status_pesanan', 'proses')->count();
        
        // Pendapatan hari ini (Hanya yang statusnya LUNAS)
        $pendapatan_hari_ini = Transaksi::whereDate('created_at', Carbon::today())
                                        ->where('status_pembayaran', 'lunas')
                                        ->sum('total_bayar');
                                        
        // Pendapatan bulan ini
        $pendapatan_bulan_ini = Transaksi::whereMonth('created_at', Carbon::now()->month)
                                         ->whereYear('created_at', Carbon::now()->year)
                                         ->where('status_pembayaran', 'lunas')
                                         ->sum('total_bayar');

        // 2. Data untuk Grafik (Pendapatan 7 Hari Terakhir)
        $grafik_tanggal = [];
        $grafik_pendapatan = [];

        // Looping mundur dari 6 hari yang lalu sampai hari ini
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            $grafik_tanggal[] = $tanggal->translatedFormat('d M'); // Format: 11 Mar
            
            // Hitung total lunas per hari tersebut
            $total_per_hari = Transaksi::whereDate('created_at', $tanggal)
                                       ->where('status_pembayaran', 'lunas')
                                       ->sum('total_bayar');
                                       
            $grafik_pendapatan[] = $total_per_hari;
        }

        return view('dashboard', compact(
            'total_pelanggan', 
            'cucian_proses', 
            'pendapatan_hari_ini', 
            'pendapatan_bulan_ini',
            'grafik_tanggal',
            'grafik_pendapatan'
        ));
    }
}