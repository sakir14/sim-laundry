<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('pelanggan.index') }}" class="btn-secondary py-2 px-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-2xl text-slate-800">Edit Pelanggan</h2>
                <p class="text-sm text-slate-500">{{ $pelanggan->nama_pelanggan }}</p>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-amber-50">
                    <h3 class="font-black text-amber-800 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Data Pelanggan
                    </h3>
                </div>
                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Pelanggan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" class="input-modern" required>
                        <x-input-error :messages="$errors->get('nama_pelanggan')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}" class="input-modern" required>
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" class="input-modern" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('pelanggan.index') }}" class="btn-secondary flex-1 justify-center">Batal</a>
                        <button type="submit" class="btn-warning flex-1 justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
