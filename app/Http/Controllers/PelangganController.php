<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan; // Wajib dipanggil
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function lookup(Request $request)
    {
        $noHp = trim((string) $request->query('no_hp', ''));

        if ($noHp === '') {
            return response()->json(['found' => false]);
        }

        $pelanggan = Pelanggan::where('no_hp', $noHp)->first();
        $normalizedNoHp = preg_replace('/\D+/', '', $noHp);

        if (!$pelanggan && $normalizedNoHp !== '') {
            $pelanggan = Pelanggan::latest()
                ->get()
                ->first(function ($pelanggan) use ($normalizedNoHp) {
                    return preg_replace('/\D+/', '', $pelanggan->no_hp) === $normalizedNoHp;
                });
        }

        if (!$pelanggan) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'pelanggan' => [
                'id' => $pelanggan->id,
                'nama_pelanggan' => $pelanggan->nama_pelanggan,
                'no_hp' => $pelanggan->no_hp,
                'alamat' => $pelanggan->alamat,
            ],
        ]);
    }

  public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search');

        // Kita buat pondasi query-nya dulu
        $query = Pelanggan::query();

        // Jika ada ketikan di kolom pencarian, jalankan filter ini
        if ($search) {
            $query->where('nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
        }

        // withQueryString() ini SANGAT PENTING agar pencarian tidak hilang saat pindah halaman!
        $pelanggans = $query->latest()->paginate(10)->withQueryString();

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil diperbarui!');
    }

   public function destroy(string $id)
    {
        try {
            $pelanggan = \App\Models\Pelanggan::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error jika data nyangkut di tabel transaksi (kode 23000)
            if ($e->getCode() == "23000") {
                return redirect()->route('pelanggan.index')->with('error', 'GAGAL: Pelanggan tidak bisa dihapus karena sudah memiliki riwayat transaksi!');
            }
            
            return redirect()->route('pelanggan.index')->with('error', 'Terjadi kesalahan sistem saat menghapus data.');
        }
    }
}
