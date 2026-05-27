<x-app-layout  :pageTitle="'Pelanggan'">
    <x-slot name="header">

    <div class="relative overflow-hidden rounded-3xl
                bg-gradient-to-r from-emerald-600 via-green-600 to-teal-700
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
        <div class="relative z-10 flex flex-col gap-4 lg:flex-row
                    lg:items-center lg:justify-between"
             data-aos="fade-right">

            {{-- LEFT --}}
            <div>

                <h2 class="text-3xl font-black text-white drop-shadow-sm">
                    Data Pelanggan
                </h2>

                <p class="mt-1 text-sm text-emerald-100">
                    Kelola semua data pelanggan laundry
                </p>

            </div>

            {{-- RIGHT --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                {{-- SEARCH --}}
                <form
                    action="{{ route('pelanggan.index') }}"
                    method="GET"
                    class="flex gap-2"
                >

                    <div class="relative">

                        {{-- SEARCH ICON --}}
                        <svg
                            class="absolute left-4 top-1/2 h-4 w-4
                                   -translate-y-1/2 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5
                                   a7 7 0 11-14 0
                                   7 7 0 0114 0z"
                            />
                        </svg>

                        {{-- INPUT --}}
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama / no hp..."
                            class="w-64 rounded-2xl border border-white/20
                                   bg-white/90
                                   py-3 pl-11 pr-10
                                   text-sm text-slate-700
                                   shadow-sm
                                   backdrop-blur-md
                                   transition
                                   placeholder:text-slate-400
                                   focus:border-white
                                   focus:ring focus:ring-white/30"
                        >

                        {{-- CLEAR BUTTON --}}
                        @if(request('search'))

                        <a href="{{ route('pelanggan.index') }}"
                           class="absolute right-3 top-1/2
                                  -translate-y-1/2
                                  text-slate-400
                                  transition-colors
                                  hover:text-red-500">

                            <svg
                                class="h-4 w-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0
                                       L10 8.586l4.293-4.293
                                       a1 1 0 111.414 1.414
                                       L11.414 10l4.293 4.293
                                       a1 1 0 01-1.414 1.414
                                       L10 11.414l-4.293 4.293
                                       a1 1 0 01-1.414-1.414
                                       L8.586 10 4.293 5.707
                                       a1 1 0 010-1.414z"
                                />
                            </svg>

                        </a>

                        @endif

                    </div>

                    {{-- BUTTON SEARCH --}}
                    <button
                        type="submit"
                        class="rounded-2xl bg-white/15
                               px-5 py-3
                               text-sm font-bold text-white
                               backdrop-blur-md
                               border border-white/20
                               transition-all duration-300
                               hover:bg-white/20
                               hover:-translate-y-0.5"
                    >
                        Cari
                    </button>

                </form>

                {{-- BUTTON TAMBAH --}}
                <a href="{{ route('pelanggan.create') }}"
                   class="group flex items-center justify-center gap-2
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

                    Tambah

                </a>

            </div>

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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">

                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Daftar Pelanggan</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold bg-slate-100 px-3 py-1 rounded-full">
                        {{ $pelanggans->count() }} pelanggan
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-row-anim">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest w-12">No</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Nama Pelanggan</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">No. HP</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Alamat</th>
                                <th class="px-6 py-3.5 text-center text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($pelanggans as $index => $pelanggan)
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($pelanggan->nama_pelanggan, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-slate-800 text-sm">{{ $pelanggan->nama_pelanggan }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-600 font-mono">{{ $pelanggan->no_hp }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-500 truncate block max-w-xs">{{ $pelanggan->alamat }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}"
                                           class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn-hapus inline-flex items-center gap-1 bg-red-100 text-red-700 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold">
                                            {{ request('search') ? 'Pelanggan tidak ditemukan' : 'Belum ada data pelanggan' }}
                                        </p>
                                        <a href="{{ route('pelanggan.create') }}" class="text-emerald-600 text-sm font-bold hover:underline">+ Tambah Pelanggan Baru</a>
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
            Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}', showConfirmButton:false, timer:2000, timerProgressBar:true });
            @endif
            @if(session('error'))
            Swal.fire({ icon:'error', title:'Oops!', text:'{{ session('error') }}', confirmButtonColor:'#ef4444' });
            @endif

            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Hapus Pelanggan?', icon: 'warning',
                        text: 'Data yang dihapus tidak bisa dikembalikan!',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal', reverseButtons: true
                    }).then(r => { if (r.isConfirmed) form.submit(); });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
