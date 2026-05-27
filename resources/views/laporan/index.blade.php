
<x-app-layout :pageTitle="'Laporan Pendapatan ' . \Carbon\Carbon::parse($tgl_awal)->translatedFormat('d F Y') . ' sd ' . \Carbon\Carbon::parse($tgl_akhir)->translatedFormat('d F Y')">
   <x-slot name="header">

    <div class="relative overflow-hidden rounded-3xl
                bg-gradient-to-r from-amber-500 via-orange-500 to-red-600
                px-6 py-6 shadow-xl print-hidden">

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
                    Laporan Pendapatan
                </h2>

                <p class="mt-1 text-sm text-orange-100">
                    Analisa pendapatan laundry berdasarkan periode
                </p>

            </div>

            {{-- BUTTON --}}
            <button
                onclick="window.print()"
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
                       hover:shadow-lg
                       print-hidden"
            >

                <svg
                    class="h-5 w-5 transition-transform duration-300
                           group-hover:scale-110"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0
                           00-2-2H5a2 2 0 00-2 2v4a2 2 0
                           002 2h2m2 4h6a2 2 0 002-2v-4
                           a2 2 0 00-2-2H9a2 2 0 00-2 2v4
                           a2 2 0 002 2zm8-12V5a2 2 0
                           00-2-2H9a2 2 0 00-2 2v4h10z"
                    />
                </svg>

                Cetak Laporan

            </button>

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

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            <!-- Filter Box -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 print-hidden" data-aos="fade-down" data-aos-delay="50">
                <h3 class="text-sm font-bold text-slate-700 flex items-center gap-2 mb-4">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter Periode Laporan
                </h3>
                <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" value="{{ $tgl_awal }}" class="input-modern">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}" class="input-modern">
                    </div>
                    <button type="submit" class="btn-primary text-sm whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Tampilkan
                    </button>
                </form>
            </div>

            <!-- Report Document -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">

                <!-- Kop Surat -->
                <div class="p-8 border-b border-slate-200 text-center">
                    <div class="flex items-center justify-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-800 tracking-wider">AWAN<span class="text-blue-600">-LAUNDRY</span></h2>
                            <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold">Sistem Informasi Manajemen Laundry</p>
                        </div>
                    </div>
                    <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-200 rounded-xl px-4 py-2 mt-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-sm font-bold text-indigo-700">
                            Periode: {{ \Carbon\Carbon::parse($tgl_awal)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($tgl_akhir)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-blue-600 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-white">
                        <p class="text-indigo-200 text-xs font-bold uppercase tracking-widest">Total Pendapatan Periode Ini</p>
                        <p class="text-3xl font-black mt-1">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right text-white">
                        <p class="text-indigo-200 text-xs font-bold uppercase tracking-widest">Jumlah Transaksi</p>
                        <p class="text-3xl font-black mt-1">{{ count($transaksis) }} Nota</p>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="py-4 px-6 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Tanggal</th>
                                <th class="py-4 px-6 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">No. Nota</th>
                                <th class="py-4 px-6 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Pelanggan</th>
                                <th class="py-4 px-6 text-right text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($transaksis as $trx)
                            <tr class="hover:bg-indigo-50/40 transition-colors duration-150">
                                <td class="py-3.5 px-6">
                                    <p class="text-sm text-slate-700 font-medium">{{ $trx->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-400">{{ $trx->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="font-mono font-bold text-indigo-600 text-sm">#{{ $trx->no_nota }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-semibold text-slate-800 text-sm">{{ $trx->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                                <td class="py-3.5 px-6 text-right font-mono font-bold text-slate-800 text-sm">Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold">Tidak ada transaksi lunas pada periode ini</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="bg-indigo-50 border-t-2 border-indigo-200">
                                <td colspan="3" class="py-4 px-6 text-right font-extrabold text-slate-700 uppercase text-sm tracking-wider">Total Pendapatan:</td>
                                <td class="py-4 px-6 text-right font-mono font-black text-indigo-700 text-xl">
                                    Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Signature (Print Only) -->
                <div class="hidden print-show mt-16 text-right px-8 pb-8">
                    <p class="text-slate-700 mb-20 font-medium">Indramayu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <div class="inline-block text-center">
                        <p class="font-extrabold text-slate-900 border-b-2 border-slate-900 pb-1 px-4">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-slate-600 mt-1 font-bold">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .print-hidden { display: none !important; }
            .print-show { display: block !important; }
            body { background: white !important; }
            .shadow-sm, .shadow-lg { box-shadow: none !important; }
        }
    </style>
</x-app-layout>
