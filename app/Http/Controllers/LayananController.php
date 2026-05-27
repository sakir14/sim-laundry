<?php

namespace App\Http\Controllers;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        // Mengambil semua data layanan dari database
        $layanans = Layanan::all(); 
        
        // Mengirim data ke halaman view 'layanan.index'
        return view('layanan.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan halaman form tambah data
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang diinput kasir/admin
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'satuan' => 'required|in:kg,pcs',
        ]);

        // 2. Simpan ke database MySQL
        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
        ]);

        // 3. Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('layanan.index')->with('success', 'Paket Layanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {
        // Mencari data layanan berdasarkan ID
        $layanan = Layanan::findOrFail($id);
        
        // Menampilkan halaman form edit dengan membawa data lama
        return view('layanan.edit', compact('layanan'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi inputan baru
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'satuan' => 'required|in:kg,pcs',
        ]);

        // 2. Cari data lama, lalu update dengan data baru
        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
        ]);

        // 3. Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('layanan.index')->with('success', 'Data Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        // Cari data berdasarkan ID, lalu hapus dari database
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        // Kembalikan ke halaman tabel
        return redirect()->route('layanan.index')->with('success', 'Data Layanan berhasil dihapus!');
    }
}
