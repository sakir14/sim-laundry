<x-app-layout  :pageTitle="'User'">
    <x-slot name="header">

    <div class="relative overflow-hidden rounded-3xl
                bg-gradient-to-r from-fuchsia-600 via-violet-600 to-purple-700
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
                    Kelola Pengguna
                </h2>

                <p class="mt-1 text-sm text-fuchsia-100">
                    Manajemen akun admin & kasir sistem
                </p>

            </div>

            {{-- BUTTON --}}
            <a href="{{ route('user.create') }}"
               class="group inline-flex items-center gap-2
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
                           group-hover:rotate-12"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3
                           m-2-5a4 4 0 11-8 0 4 4 0
                           018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                    />
                </svg>

                Tambah Akun

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
                        <div class="w-1.5 h-6 bg-violet-500 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Daftar Akun Sistem</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold bg-slate-100 px-3 py-1 rounded-full">{{ count($users) }} akun</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-row-anim">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest w-12">No</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Nama Pengguna</th>
                                <th class="px-6 py-3.5 text-left text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Email</th>
                                <th class="px-6 py-3.5 text-center text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Role</th>
                                <th class="px-6 py-3.5 text-center text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($users as $index => $u)
                            <tr class="hover:bg-violet-50/40 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br {{ $u->role === 'admin' ? 'from-violet-400 to-violet-600' : 'from-blue-400 to-blue-600' }} flex items-center justify-center text-white text-sm font-bold flex-shrink-0 shadow-sm">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800 text-sm flex items-center gap-2">
                                                {{ $u->name }}
                                                @if(auth()->id() == $u->id)
                                                <span class="text-[10px] font-extrabold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-md uppercase tracking-wider">Kamu</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $u->email }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $u->role === 'admin' ? 'bg-violet-100 text-violet-700 border border-violet-200' : 'bg-blue-100 text-blue-700 border border-blue-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $u->role === 'admin' ? 'bg-violet-500' : 'bg-blue-500' }}"></span>
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('user.edit', $u->id) }}"
                                           class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200">
                                            Edit
                                        </a>
                                        @if(auth()->id() != $u->id)
                                        <form action="{{ route('user.destroy', $u->id) }}" method="POST" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn-hapus inline-flex items-center gap-1 bg-red-100 text-red-700 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <p class="text-slate-500 font-semibold">Belum ada pengguna lainnya.</p>
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
            Swal.fire({ icon:'error', title:'Akses Ditolak!', text:'{{ session('error') }}', confirmButtonColor:'#ef4444' });
            @endif
            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Hapus Akun Ini?', icon: 'warning',
                        text: 'Pengguna ini tidak dapat login lagi ke sistem!',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, cabut akses!', cancelButtonText: 'Batal', reverseButtons: true
                    }).then(r => { if (r.isConfirmed) form.submit(); });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
