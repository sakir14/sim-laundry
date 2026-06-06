<x-app-layout  :pageTitle="'Transaksi'">
    <x-slot name="header">

    <div class="relative overflow-hidden rounded-3xl
                bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-700
                px-6 py-6 shadow-xl">

        {{-- BUBBLE ANIMATION --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">

            <div class="bubble bubble-1"></div>
            <div class="bubble bubble-2"></div>
            <div class="bubble bubble-3"></div>
            <div class="bubble bubble-4"></div>
            <div class="bubble bubble-5"></div>

        </div>

        {{-- CONTENT --}}
        <div class="relative z-10 flex items-center justify-between"
             data-aos="fade-right">

            {{-- LEFT --}}
            <div>

                <h2 class="text-3xl font-black text-white drop-shadow-sm">
                    Data Transaksi
                </h2>

                <p class="mt-1 text-sm text-blue-100">
                    Kelola semua transaksi laundry
                </p>

            </div>

            {{-- BUTTON --}}
            <a href="{{ route('transaksi.create') }}"
               class="group flex items-center gap-2
                      rounded-2xl
                      bg-white/15
                      px-5 py-3
                      text-sm font-bold text-white
                      backdrop-blur-md
                      border border-white/20
                      transition-all duration-300
                      hover:-translate-y-0.5
                      hover:bg-white/20
                      hover:shadow-lg">

                <svg
                    class="h-5 w-5 transition-transform duration-300
                           group-hover:rotate-90"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Transaksi Baru

            </a>

        </div>

    </div>

    {{-- STYLE --}}
    <style>

        .bubble{
            position: absolute;
            border-radius: 9999px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(2px);
            animation: floatBubble 10s infinite ease-in-out;
        }

        .bubble-1{
            width: 120px;
            height: 120px;
            left: -30px;
            top: 20px;
            animation-delay: 0s;
        }

        .bubble-2{
            width: 80px;
            height: 80px;
            right: 120px;
            top: -20px;
            animation-delay: 2s;
        }

        .bubble-3{
            width: 60px;
            height: 60px;
            right: 40px;
            bottom: 10px;
            animation-delay: 4s;
        }

        .bubble-4{
            width: 100px;
            height: 100px;
            left: 40%;
            bottom: -40px;
            animation-delay: 1s;
        }

        .bubble-5{
            width: 50px;
            height: 50px;
            left: 60%;
            top: 10px;
            animation-delay: 3s;
        }

        @keyframes floatBubble {

            0%{
                transform: translateY(0px) scale(1);
            }

            50%{
                transform: translateY(-15px) scale(1.05);
            }

            100%{
                transform: translateY(0px) scale(1);
            }

        }

    </style>

</x-slot>

    @php
        $statusPesananLabels = [
            'proses' => 'Sedang Dicuci',
            'selesai' => 'Siap Diambil/Dikirim',
            'diambil' => 'Sudah Diambil',
            'diantar' => 'Sudah Dikirim',
        ];

        $statusPembayaranLabels = [
            'belum_lunas' => 'Belum Lunas',
            'lunas' => 'Lunas',
        ];

        $sedangFilter = ($search ?? '') !== '' || ($statusPesanan ?? '') !== '' || ($statusPembayaran ?? '') !== '';
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">

                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Daftar Cucian Masuk</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold bg-slate-100 px-3 py-1 rounded-full">
                        {{ count($transaksis ?? []) }} dari {{ $totalTransaksi ?? count($transaksis ?? []) }} transaksi
                    </span>
                </div>

                <!-- Search Filter -->
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                    <form action="{{ route('transaksi.index') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-3 lg:items-end">
                        <div class="lg:col-span-5">
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5">Cari Transaksi</label>
                            <div class="relative">
                                <svg class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.4"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                <input type="text" name="search" value="{{ $search ?? '' }}" class="input-modern !pl-12 text-sm" placeholder="No nota, nama pelanggan, no HP, layanan, status">
                            </div>
                        </div>
                        <div class="lg:col-span-3">
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5">Status Cucian</label>
                            <select name="status_pesanan" class="input-modern text-sm">
                                <option value="">Semua Status</option>
                                @foreach($statusPesananLabels as $value => $label)
                                <option value="{{ $value }}" @selected(($statusPesanan ?? '') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5">Pembayaran</label>
                            <select name="status_pembayaran" class="input-modern text-sm">
                                <option value="">Semua</option>
                                @foreach($statusPembayaranLabels as $value => $label)
                                <option value="{{ $value }}" @selected(($statusPembayaran ?? '') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="lg:col-span-2 flex gap-2">
                            <button type="submit" class="btn-primary flex-1 justify-center text-sm py-2.5">
                                Cari
                            </button>
                            @if($sedangFilter)
                            <a href="{{ route('transaksi.index') }}" class="btn-secondary justify-center text-sm py-2.5 px-3">
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full table-row-anim">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">No Nota</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Tanggal</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Pelanggan</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Layanan</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Total Bayar</th>
                                <th class="px-6 py-3.5 text-center text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($transaksis ?? [] as $t)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-150 group">
                                <td class="px-6 py-4">
                                    <span class="font-mono font-bold text-blue-600 text-sm">{{ $t->no_nota }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-700 font-medium">{{ $t->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-400">{{ $t->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-sm">
                                            {{ strtoupper(substr($t->pelanggan->nama_pelanggan ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-slate-800 text-sm">{{ $t->pelanggan->nama_pelanggan ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $rincian = $t->rincian_layanan;
                                        $namaLayanan = $rincian->map(fn ($detail) => $detail->layanan->nama_layanan ?? '-')->take(2)->implode(', ');
                                    @endphp
                                    <p class="text-sm text-slate-700 font-bold">{{ $namaLayanan ?: '-' }}</p>
                                    <p class="text-xs text-slate-400">{{ $rincian->count() }} item layanan</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1.5">
                                        @php $sp = strtolower($t->status_pesanan); @endphp
                                        <span class="{{ $sp === 'proses' ? 'badge-proses' : ($sp === 'selesai' ? 'badge-selesai' : 'badge-diambil') }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $sp === 'proses' ? 'bg-amber-500' : ($sp === 'selesai' ? 'bg-emerald-500' : 'bg-blue-500') }}"></span>
                                            {{ $t->status_pesanan_label }}
                                        </span>
                                        <span class="{{ $t->status_pembayaran === 'lunas' ? 'badge-lunas' : 'badge-belum' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $t->status_pembayaran === 'lunas' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                            {{ $statusPembayaranLabels[$t->status_pembayaran] ?? ucfirst($t->status_pembayaran) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono font-bold text-slate-800 text-sm">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('transaksi.show', $t->id) }}"
                                       class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Ubah Status
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold">{{ $sedangFilter ? 'Tidak ada transaksi yang cocok dengan pencarian' : 'Belum ada transaksi' }}</p>
                                        @if($sedangFilter)
                                        <a href="{{ route('transaksi.index') }}" class="text-blue-600 text-sm font-bold hover:underline">Tampilkan semua transaksi</a>
                                        @else
                                        <a href="{{ route('transaksi.create') }}" class="text-blue-600 text-sm font-bold hover:underline">+ Buat Transaksi Baru</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
