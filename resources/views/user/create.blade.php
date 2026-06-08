<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" data-aos="fade-right">
            <a href="{{ route('user.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800">Tambah Akun Pengguna</h2>
                <p class="text-sm text-slate-500 mt-0.5">Buat akun kasir atau admin baru</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-violet-50">
                    <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                    <h3 class="font-black text-violet-900 text-sm">Data Akun Baru</h3>
                </div>
                <form action="{{ route('user.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="input-modern @error('name') border-red-400 @enderror" placeholder="Contoh: Budi Kasir" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Email Login <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <svg class="field-icon w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <input type="email" name="email" value="{{ old('email') }}" class="input-modern input-with-icon @error('email') border-red-400 @enderror" placeholder="kasir@laundry.com" required>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <svg class="field-icon w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <input type="password" name="password" class="input-modern input-with-icon @error('password') border-red-400 @enderror" placeholder="Min. 8 karakter" minlength="8" required>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Hak Akses (Role) <span class="text-red-500">*</span></label>
                        <select name="role" class="input-modern" required>
                            <option value="kasir" {{ old('role')=='kasir' ? 'selected' : '' }}>👤 Kasir — Hanya kelola transaksi</option>
                            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>🔑 Admin — Akses penuh semua fitur</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('user.index') }}" class="btn-secondary flex-1 justify-center text-sm">Batal</a>
                        <button type="submit" class="flex-1 justify-center inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition-all duration-200 text-sm hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Buat Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
