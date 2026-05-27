<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan; // Panggil Pelanggan
use App\Models\Layanan;   // Panggil Layanan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $statusPesanan = $request->input('status_pesanan');
        $statusPembayaran = $request->input('status_pembayaran');

        $query = Transaksi::with(['pelanggan', 'layanan', 'details.layanan', 'user']);

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('no_nota', 'like', "%{$search}%")
                    ->orWhere('status_pesanan', 'like', "%{$search}%")
                    ->orWhere('status_pembayaran', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', function ($pelangganQuery) use ($search) {
                        $pelangganQuery->where('nama_pelanggan', 'like', "%{$search}%")
                            ->orWhere('no_hp', 'like', "%{$search}%");
                    })
                    ->orWhereHas('layanan', function ($layananQuery) use ($search) {
                        $layananQuery->where('nama_layanan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('details.layanan', function ($layananQuery) use ($search) {
                        $layananQuery->where('nama_layanan', 'like', "%{$search}%");
                    });
            });
        }

        if (in_array($statusPesanan, ['proses', 'selesai', 'diambil', 'diantar'], true)) {
            $query->where('status_pesanan', $statusPesanan);
        } else {
            $statusPesanan = '';
        }

        if (in_array($statusPembayaran, ['belum_lunas', 'lunas'], true)) {
            $query->where('status_pembayaran', $statusPembayaran);
        } else {
            $statusPembayaran = '';
        }

        $transaksis = $query->latest()->get();
        $totalTransaksi = Transaksi::count();

        return view('transaksi.index', compact(
            'transaksis',
            'search',
            'statusPesanan',
            'statusPembayaran',
            'totalTransaksi'
        ));
    }

   public function create()
    {
        // Kita tidak perlu lagi memanggil $pelanggans di sini
        $layanans = Layanan::all();
        $no_nota = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::count() + 1, 4, '0', STR_PAD_LEFT);

        return view('transaksi.create', compact('layanans', 'no_nota'));
    }

    // ... (biarkan store, edit, dll kosong dulu)
    public function store(Request $request)
    {
        if (!$request->filled('items') && $request->filled('layanan_id')) {
            $request->merge([
                'items' => [
                    [
                        'layanan_id' => $request->layanan_id,
                        'jumlah' => $request->berat,
                    ],
                ],
            ]);
        }

        // 1. Validasi data yang masuk (Sekarang memvalidasi inputan pelanggan juga)
        $validated = $request->validate([
            'no_nota' => 'required|unique:transaksis',
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.layanan_id' => 'required|exists:layanans,id',
            'items.*.jumlah' => 'required|numeric|min:0.1',
            'jenis_pengambilan' => 'required|in:ambil_sendiri,antar,antar_jemput',
            'alamat_pengiriman' => 'nullable|string',
            'biaya_ongkir' => 'nullable|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_lunas,lunas',
        ]);

        $layanans = Layanan::whereIn('id', collect($validated['items'])->pluck('layanan_id'))
            ->get()
            ->keyBy('id');

        $details = collect($validated['items'])->map(function ($item) use ($layanans) {
            $layanan = $layanans->get($item['layanan_id']);
            $jumlah = (float) $item['jumlah'];
            $harga = (int) $layanan->harga;

            return [
                'layanan_id' => $layanan->id,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'satuan' => $layanan->satuan,
                'subtotal' => (int) round($harga * $jumlah),
            ];
        });

        $butuhKurir = in_array($validated['jenis_pengambilan'], ['antar', 'antar_jemput'], true);
        $ongkir = $butuhKurir
            ? (int) ($validated['biaya_ongkir'] ?? 0)
            : 0;
        $subtotalLayanan = $details->sum('subtotal');
        $totalBayar = $subtotalLayanan + $ongkir;
        $firstDetail = $details->first();

        DB::transaction(function () use ($validated, $details, $firstDetail, $ongkir, $totalBayar, $butuhKurir) {
            // 2. Cari Pelanggan berdasarkan No HP, kalau tidak ketemu otomatis buat baru.
            $pelanggan = Pelanggan::firstOrCreate(
                ['no_hp' => $validated['no_hp']],
                [
                    'nama_pelanggan' => $validated['nama_pelanggan'],
                    'alamat' => $validated['alamat'],
                ]
            );

            // 3. Simpan header transaksi, lalu simpan semua rincian layanannya.
            $transaksi = Transaksi::create([
                'no_nota' => $validated['no_nota'],
                'pelanggan_id' => $pelanggan->id,
                'layanan_id' => $firstDetail['layanan_id'],
                'user_id' => Auth::id(),
                'berat' => $firstDetail['jumlah'],
                'biaya_ongkir' => $ongkir,
                'total_bayar' => $totalBayar,
                'status_pembayaran' => $validated['status_pembayaran'],
                'status_pesanan' => 'proses',
                'jenis_pengambilan' => $validated['jenis_pengambilan'],
                'alamat_pengiriman' => $butuhKurir
                    ? ($validated['alamat_pengiriman'] ?? null)
                    : null,
            ]);

            $transaksi->details()->createMany($details->all());
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
    }
    public function show(string $id)
    {
        // Ambil data transaksi beserta relasinya
        $transaksi = Transaksi::with(['pelanggan', 'layanan', 'details.layanan', 'user'])->findOrFail($id);
        
        return view('transaksi.show', compact('transaksi'));
    }
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // Update status pesanan dan pembayaran
        $transaksi->update([
            'status_pesanan' => $request->status_pesanan,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('transaksi.show', $id)->with('success', 'Status Transaksi berhasil diperbarui!');
    }

   public function cetak(string $id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'layanan', 'details.layanan', 'user'])->findOrFail($id);
        
        // Kembalikan ke tampilan HTML/CSS biasa
        return view('transaksi.cetak', compact('transaksi'));
    }
}   
