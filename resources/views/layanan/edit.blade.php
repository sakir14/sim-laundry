<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('layanan.index') }}" class="btn-secondary py-2 px-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-2xl text-slate-800">Edit Layanan</h2>
                <p class="text-sm text-slate-500">{{ $layanan->nama_layanan }}</p>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-amber-50">
                    <h3 class="font-black text-amber-800 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Layanan
                    </h3>
                </div>
                <form action="{{ route('layanan.update', $layanan->id) }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Layanan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" class="input-modern" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="harga" value="{{ old('harga', $layanan->harga) }}" class="input-modern" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Satuan <span class="text-red-500">*</span></label>
                            <select name="satuan" class="input-modern" required>
                                <option value="kg" {{ old('satuan',$layanan->satuan)=='kg' ? 'selected' : '' }}>Kg</option>
                                <option value="pcs" {{ old('satuan',$layanan->satuan)=='pcs' ? 'selected' : '' }}>Pcs</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('layanan.index') }}" class="btn-secondary flex-1 justify-center">Batal</a>
                        <button type="submit" class="btn-warning flex-1 justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
