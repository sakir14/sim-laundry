<x-app-layout  :pageTitle="'Layanan'">
    <x-slot name="header">

    <div class="relative overflow-hidden rounded-3xl
                bg-gradient-to-r from-violet-600 via-purple-600 to-fuchsia-700
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
                    Paket Layanan
                </h2>

                <p class="mt-1 text-sm text-violet-100">
                    Kelola semua paket dan harga laundry
                </p>

            </div>

            {{-- BUTTON --}}
            <a href="{{ route('layanan.create') }}"
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

                Tambah Layanan

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

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Daftar Paket Laundry</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold bg-slate-100 px-3 py-1 rounded-full">{{ count($layanans) }} paket</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-row-anim">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest w-12">No</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Nama Layanan</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Harga</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Satuan</th>
                                <th class="px-6 py-3.5 text-center text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($layanans as $index => $layanan)
                            <tr class="hover:bg-blue-50/40 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        </div>
                                        <span class="font-semibold text-slate-800 text-sm">{{ $layanan->nama_layanan }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono font-bold text-emerald-600 text-sm">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="badge-diambil uppercase">{{ $layanan->satuan }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('layanan.edit', $layanan->id) }}"
                                           class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" class="inline-block">
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
                                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold">Belum ada paket layanan</p>
                                        <a href="{{ route('layanan.create') }}" class="text-blue-600 text-sm font-bold hover:underline">+ Tambah Layanan Baru</a>
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
                        title: 'Hapus Layanan?', icon: 'warning',
                        text: 'Data layanan ini akan dihapus permanen!',
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
