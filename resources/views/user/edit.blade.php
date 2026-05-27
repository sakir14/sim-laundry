<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" data-aos="fade-right">
            <a href="{{ route('user.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800">Edit Pengguna</h2>
                <p class="text-sm text-slate-500 mt-0.5">Ubah data akun: <span class="font-bold text-violet-600">{{ $user->name }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 bg-amber-50">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-violet-700 flex items-center justify-center text-white text-lg font-black shadow-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 text-sm">{{ $user->name }}</h3>
                        <p class="text-xs text-slate-500 font-mono">{{ $user->email }}</p>
                    </div>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-modern @error('name') border-red-400 @enderror" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Email Login <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-modern @error('email') border-red-400 @enderror" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Password Baru <span class="text-slate-400 font-normal">(Kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" class="input-modern @error('password') border-red-400 @enderror" placeholder="••••••••" minlength="8">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Hak Akses <span class="text-red-500">*</span></label>
                        <select name="role" class="input-modern" required>
                            <option value="kasir" {{ $user->role=='kasir' ? 'selected' : '' }}>👤 Kasir</option>
                            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>🔑 Admin</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('user.index') }}" class="btn-secondary flex-1 justify-center text-sm">Batal</a>
                        <button type="submit" class="btn-warning flex-1 justify-center text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
