<section class="space-y-4">
    <p class="text-sm text-slate-500 leading-relaxed">
        Setelah akun dihapus, semua data dan resource akan dihapus permanen. Pastikan Anda sudah mengunduh semua data penting sebelum menghapus akun.
    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 font-bold px-4 py-2.5 rounded-xl text-sm transition-all duration-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h2 class="text-lg font-black text-slate-800">Hapus Akun?</h2>
            </div>

            <p class="text-sm text-slate-500">
                Setelah dihapus, semua data akun ini akan hilang permanen dan tidak bisa dikembalikan. Masukkan password untuk konfirmasi.
            </p>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Password Konfirmasi</label>
                <input id="password" name="password" type="password" class="input-modern" placeholder="Masukkan password Anda">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1 text-xs text-red-500" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" x-on:click="$dispatch('close')" class="btn-secondary text-sm">Batal</button>
                <button type="submit" class="btn-danger text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Ya, Hapus Akun Saya
                </button>
            </div>
        </form>
    </x-modal>
</section>
