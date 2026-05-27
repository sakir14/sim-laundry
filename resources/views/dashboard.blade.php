<x-app-layout>
    <x-slot name="header">

    <div class="relative overflow-hidden rounded-3xl
                bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700
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

            <div>

                <h2 class="text-3xl font-black text-white drop-shadow-sm">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-blue-100">
                    Selamat datang kembali,

                    <span class="font-bold text-white">
                        {{ Auth::user()->name }}
                    </span> 
                </p>

            </div>

            <div class="hidden text-right sm:block">

                <p class="text-sm font-bold text-blue-100"
                   id="current-time">
                </p>

                <p class="text-sm font-medium text-blue-200"
                   id="current-date">
                </p>

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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- STAT CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 {{ Auth::user()->role === 'admin' ? 'lg:grid-cols-4' : 'lg:grid-cols-2' }} gap-4">

                <!-- Cucian Diproses -->
                <div data-aos="fade-up" data-aos-delay="50"
                     class="stat-card relative rounded-2xl p-6 shadow-lg overflow-hidden cursor-pointer group hover:-translate-y-1 transition-all duration-300"
                     style="background: linear-gradient(135deg, #1d4ed8, #2563eb);">
                    <div class="absolute top-3 right-4 opacity-20 group-hover:opacity-30 transition-opacity">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-4 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-1">Cucian Diproses</p>
                    <div class="flex items-end gap-2">
                        <span id="counter-proses" class="text-4xl font-black text-white">0</span>
                        <span class="text-blue-200 text-sm mb-1 font-semibold">Nota</span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <a href="{{ route('transaksi.index') }}" class="text-blue-100 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                            Lihat semua <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Total Pelanggan -->
                <div data-aos="fade-up" data-aos-delay="100"
                     class="stat-card relative rounded-2xl p-6 shadow-lg overflow-hidden cursor-pointer group hover:-translate-y-1 transition-all duration-300"
                     style="background: linear-gradient(135deg, #059669, #10b981);">
                    <div class="absolute top-3 right-4 opacity-20">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p class="text-emerald-100 text-xs font-bold uppercase tracking-widest mb-1">Total Pelanggan</p>
                    <div class="flex items-end gap-2">
                        <span id="counter-pelanggan" class="text-4xl font-black text-white">0</span>
                        <span class="text-emerald-200 text-sm mb-1 font-semibold">Orang</span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <a href="{{ route('pelanggan.index') }}" class="text-emerald-100 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                            Lihat semua <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                <!-- Pendapatan Hari Ini -->
                <div data-aos="fade-up" data-aos-delay="150"
                     class="stat-card relative rounded-2xl p-6 shadow-lg overflow-hidden cursor-pointer group hover:-translate-y-1 transition-all duration-300"
                     style="background: linear-gradient(135deg, #d97706, #f59e0b);">
                    <div class="absolute top-3 right-4 opacity-20">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-amber-100 text-xs font-bold uppercase tracking-widest mb-1">Pendapatan Hari Ini</p>
                    <div>
                        <span id="counter-hari" class="text-2xl font-black text-white">Rp 0</span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <a href="{{ route('laporan.index') }}" class="text-amber-100 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                            Lihat laporan <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Pendapatan Bulan Ini -->
                <div data-aos="fade-up" data-aos-delay="200"
                     class="stat-card relative rounded-2xl p-6 shadow-lg overflow-hidden cursor-pointer group hover:-translate-y-1 transition-all duration-300"
                     style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);">
                    <div class="absolute top-3 right-4 opacity-20">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <p class="text-purple-100 text-xs font-bold uppercase tracking-widest mb-1">Pendapatan Bulan Ini</p>
                    <div>
                        <span id="counter-bulan" class="text-2xl font-black text-white">Rp 0</span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <a href="{{ route('laporan.index') }}" class="text-purple-100 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                            Lihat laporan <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- QUICK ACTIONS -->
            <div data-aos="fade-up" data-aos-delay="250" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-4">Aksi Cepat</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('transaksi.create') }}"
                       class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2.5 rounded-xl shadow-sm hover:shadow-blue-200 transition-all duration-200 text-sm hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Transaksi Baru
                    </a>
                    <a href="{{ route('pelanggan.create') }}"
                       class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl shadow-sm transition-all duration-200 text-sm hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Tambah Pelanggan
                    </a>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('laporan.index') }}"
                       class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-bold px-4 py-2.5 rounded-xl shadow-sm transition-all duration-200 text-sm hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Laporan Pendapatan
                    </a>
                    @endif
                </div>
            </div>

            <!-- CHART (Admin Only) -->
            @if(Auth::user()->role === 'admin')
            <div data-aos="fade-up" data-aos-delay="300" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Grafik Pendapatan</h3>
                        <p class="text-xs text-slate-400 mt-0.5">7 Hari Terakhir (Transaksi Lunas)</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-xs text-slate-500 font-medium">Pendapatan (Rp)</span>
                    </div>
                </div>
                <div class="relative h-72">
                    <canvas id="grafikPendapatan"></canvas>
                </div>
            </div>
            @endif

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Clock
        function updateClock() {
            const now = new Date();
            const timeEl = document.getElementById('current-time');
            const dateEl = document.getElementById('current-date');
            if (timeEl) timeEl.textContent = now.toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit', second:'2-digit'});
            if (dateEl) dateEl.textContent = now.toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Counter animation
        function animateValue(id, start, end, duration, isCurrency = false) {
            const obj = document.getElementById(id);
            if (!obj || start === end) return;
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const ease = 1 - Math.pow(1 - progress, 4);
                const current = Math.floor(ease * (end - start) + start);
                obj.innerHTML = isCurrency ? 'Rp ' + current.toLocaleString('id-ID') : current;
                if (progress < 1) window.requestAnimationFrame(step);
                else obj.innerHTML = isCurrency ? 'Rp ' + end.toLocaleString('id-ID') : end;
            };
            window.requestAnimationFrame(step);
        }

        setTimeout(() => {
            animateValue('counter-proses', 0, {{ $cucian_proses }}, 1500);
            animateValue('counter-pelanggan', 0, {{ $total_pelanggan }}, 1500);
            @if(Auth::user()->role === 'admin')
            animateValue('counter-hari', 0, {{ $pendapatan_hari_ini ?? 0 }}, 2000, true);
            animateValue('counter-bulan', 0, {{ $pendapatan_bulan_ini ?? 0 }}, 2500, true);
            @endif
        }, 400);

        // Chart
        @if(Auth::user()->role === 'admin')
        const canvas = document.getElementById('grafikPendapatan');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 288);
            gradient.addColorStop(0, 'rgba(37, 99, 235, 0.25)');
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($grafik_tanggal ?? []) !!},
                    datasets: [{
                        label: 'Pendapatan',
                        data: {!! json_encode($grafik_pendapatan ?? []) !!},
                        borderColor: '#2563eb',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#2563eb',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 9,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    animation: { duration: 1800, easing: 'easeOutQuart' },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#94a3b8',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 10,
                            callbacks: {
                                label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(148,163,184,0.1)', drawBorder: false },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11 },
                                callback: v => 'Rp ' + (v >= 1000000 ? (v/1000000).toFixed(1) + 'jt' : v.toLocaleString('id-ID'))
                            }
                        }
                    }
                }
            });
        }
        @endif
    </script>
    @endpush
</x-app-layout>
