<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between" data-aos="fade-right">
            <div class="flex items-center gap-3">
                <a href="{{ route('transaksi.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h2 class="text-2xl font-black text-slate-800">Detail Transaksi</h2>
                    <p class="text-sm text-slate-500 mt-0.5 font-mono font-bold text-blue-600">{{ $transaksi->no_nota }}</p>
                </div>
            </div>
            <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank"
               class="btn-primary text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Nota
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-5 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 flex items-center gap-3" data-aos="fade-down">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <p class="text-emerald-700 font-semibold text-sm">{{ session('success') }}</p>
            </div>
            @endif

            @php
                $rincian = $transaksi->rincian_layanan;
                $subtotalLayanan = $rincian->sum('subtotal');
                $statusAkhirValue = $transaksi->butuh_kurir ? 'diantar' : 'diambil';
                $statusAkhirLabel = $transaksi->butuh_kurir ? 'Sudah Dikirim' : 'Sudah Diambil';
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Kiri: Info Pesanan & Pengiriman -->
                <div class="lg:col-span-2 space-y-4">

                    <!-- Informasi Pesanan -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="50">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                            <div class="w-1.5 h-5 bg-blue-600 rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Informasi Pesanan</h3>
                        </div>
                        <div class="p-5">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-slate-50 rounded-xl p-3.5">
                                    <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pelanggan</dt>
                                    <dd class="font-bold text-slate-800">{{ $transaksi->pelanggan->nama_pelanggan }}</dd>
                                    <dd class="text-xs text-slate-500 font-mono mt-0.5">{{ $transaksi->pelanggan->no_hp }}</dd>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3.5 sm:col-span-2">
                                    <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Rincian Layanan</dt>
                                    <dd class="space-y-2">
                                        @foreach($rincian as $detail)
                                        <div class="flex items-start justify-between gap-3 border-b border-slate-200/70 last:border-0 pb-2 last:pb-0">
                                            <div>
                                                <p class="font-bold text-slate-800">{{ $detail->layanan->nama_layanan ?? '-' }}</p>
                                                <p class="text-xs text-slate-500 mt-0.5">{{ $detail->jumlah_label }} {{ $detail->satuan_label }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                                            </div>
                                            <span class="font-mono font-black text-slate-800 whitespace-nowrap">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                        </div>
                                        @endforeach
                                    </dd>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3.5">
                                    <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Masuk</dt>
                                    <dd class="font-bold text-slate-800">{{ $transaksi->created_at->format('d M Y') }}</dd>
                                    <dd class="text-xs text-slate-500 mt-0.5">{{ $transaksi->created_at->format('H:i') }} WIB</dd>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3.5 sm:col-span-2">
                                    <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kasir Penerima</dt>
                                    <dd class="font-bold text-slate-800 flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center text-white text-[10px] font-bold">
                                            {{ strtoupper(substr($transaksi->user->name, 0, 1)) }}
                                        </div>
                                        {{ $transaksi->user->name }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Detail Pengiriman -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                            <div class="w-1.5 h-5 bg-violet-500 rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Detail Pengambilan</h3>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-9 h-9 rounded-xl {{ $transaksi->butuh_kurir ? 'bg-amber-100' : 'bg-blue-100' }} flex items-center justify-center">
                                    @if($transaksi->butuh_kurir)
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                    @else
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">{{ $transaksi->jenis_pengambilan_label }}</p>
                                    @if($transaksi->butuh_kurir)
                                    <p class="text-xs text-slate-500">Ongkir: <span class="font-bold text-violet-600">Rp {{ number_format($transaksi->biaya_ongkir, 0, ',', '.') }}</span></p>
                                    @endif
                                </div>
                            </div>
                            @if($transaksi->butuh_kurir && $transaksi->alamat_pengiriman)
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mt-2">
                                <p class="text-xs font-bold text-amber-600 mb-1">Alamat Kurir:</p>
                                <p class="text-sm text-slate-700">{{ $transaksi->alamat_pengiriman }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kanan: Update Status & Total -->
                <div class="space-y-4">

                    <!-- Total Tagihan -->
                    <div class="rounded-2xl p-5 shadow-lg text-center" style="background: linear-gradient(135deg, #1d4ed8, #2563eb);" data-aos="fade-up" data-aos-delay="50">
                        <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-2">Total Tagihan</p>
                        <p class="text-4xl font-black text-white mb-1">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
                        <div class="mt-3 pt-3 border-t border-white/20 space-y-1 text-xs text-blue-100 text-left">
                            <div class="flex justify-between gap-3">
                                <span>Subtotal layanan</span>
                                <span class="font-bold">Rp {{ number_format($subtotalLayanan, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between gap-3">
                                <span>Biaya ongkir</span>
                                <span class="font-bold">Rp {{ number_format($transaksi->biaya_ongkir, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            @if($transaksi->status_pembayaran === 'lunas')
                            <span class="inline-flex items-center gap-1.5 bg-emerald-400/30 text-emerald-100 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-300/30">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                LUNAS
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 bg-red-400/30 text-red-100 text-xs font-bold px-3 py-1.5 rounded-full border border-red-300/30">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                BELUM LUNAS
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Update Status -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                            <div class="w-1.5 h-5 bg-amber-500 rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Perbarui Status</h3>
                        </div>
                        <div class="p-5">
                            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="space-y-3">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Status Cucian</label>
                                    <select name="status_pesanan" class="input-modern text-sm">
                                        <option value="proses" {{ $transaksi->status_pesanan == 'proses' ? 'selected' : '' }}>Sedang Dicuci</option>
                                        <option value="selesai" {{ $transaksi->status_pesanan == 'selesai' ? 'selected' : '' }}>Siap Diambil</option>
                                        <option value="{{ $statusAkhirValue }}" {{ $transaksi->status_pesanan == $statusAkhirValue ? 'selected' : '' }}>{{ $statusAkhirLabel }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Status Pembayaran</label>
                                    <select name="status_pembayaran" class="input-modern text-sm">
                                        <option value="belum_lunas" {{ $transaksi->status_pembayaran == 'belum_lunas' ? 'selected' : '' }}>Belum lunas</option>
                                        <option value="lunas" {{ $transaksi->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
