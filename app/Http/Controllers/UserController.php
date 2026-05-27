<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Wajib untuk enkripsi password
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function index()
    {
        // Menampilkan semua user (Admin & Kasir)
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,kasir',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password otomatis
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Akun Kasir/Admin berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,kasir',
        ]);

        // Cek apakah password ikut diubah atau tidak
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Enkripsi password baru
                'role' => $request->role,
            ]);
        } else {
            // Update tanpa mengubah password lama
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Data Akun berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Mencegah admin menghapus dirinya sendiri yang sedang login
        if (Auth::id() == $user->id) {
            return redirect()->route('user.index')->with('error', 'Kamu tidak bisa menghapus akunmu sendiri saat sedang login!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Akun berhasil dihapus!');
    }
}