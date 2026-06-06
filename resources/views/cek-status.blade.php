<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Cucian — Awan Laundry</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1e40af 100%);
            overflow-x: hidden;
        }

        /* ===== BUBBLES ===== */
        .bubbles { position: fixed; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(99,179,237,.10);
            border: 1px solid rgba(99,179,237,.18);
            animation: bubbleRise linear infinite;
        }
        @keyframes bubbleRise {
            0%   { transform: translateY(100vh) scale(1); opacity: 0; }
            10%  { opacity: .6; }
            90%  { opacity: .3; }
            100% { transform: translateY(-10vh) scale(1.15); opacity: 0; }
        }

        /* ===== GRID OVERLAY ===== */
        .grid-overlay {
            position: fixed; inset: 0; z-index: 0; opacity: .05;
            background-image: linear-gradient(rgba(255,255,255,.15) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,.15) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* ===== WRAPPER ===== */
        .wrapper {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column; align-items: center;
            padding: 32px 16px 60px;
        }

        /* ===== HEADER ===== */
        .brand {
            text-align: center;
            margin-bottom: 36px;
        }
        .brand-logo {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
            box-shadow: 0 8px 32px rgba(37,99,235,.4);
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        .brand-logo svg { width: 32px; height: 32px; color: white; }
        .brand h1 { font-size: 28px; font-weight: 900; color: white; letter-spacing: 2px; }
        .brand h1 span { color: #67e8f9; }
        .brand p { color: #93c5fd; font-size: 13px; letter-spacing: 1px; font-weight: 600; margin-top: 4px; }

        /* ===== SEARCH CARD ===== */
        .search-card {
            width: 100%; max-width: 520px;
            background: rgba(255,255,255,.95);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0,0,0,.25), 0 4px 16px rgba(0,0,0,.15);
            overflow: hidden;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.3);
        }
        .card-top-bar {
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #06b6d4, #2563eb);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }
        @keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }

        .card-body { padding: 28px 28px 32px; }
        .card-title {
            font-size: 20px; font-weight: 900; color: #1e293b;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 6px;
        }
        .card-title .icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .card-desc { font-size: 13px; color: #64748b; margin-bottom: 22px; line-height: 1.6; }

        /* ===== FORM ===== */
        .input-group { position: relative; margin-bottom: 14px; }
        .input-group label {
            display: block; font-size: 11px; font-weight: 800;
            color: #64748b; letter-spacing: 1.2px; text-transform: uppercase;
            margin-bottom: 7px;
        }
        .input-group .input-wrap { position: relative; }
        .input-group input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 15px; font-weight: 700;
            color: #1e293b;
            letter-spacing: 1.5px;
            transition: all .2s;
            outline: none;
        }
        .input-group input:focus { border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37,99,235,.12); }
        .input-group input::placeholder { font-weight: 500; letter-spacing: .5px; color: #cbd5e1; }
        .input-group .input-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; pointer-events: none;
        }

        .btn-cek {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            color: white;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 15px; font-weight: 800;
            letter-spacing: .5px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all .2s;
            box-shadow: 0 6px 20px rgba(37,99,235,.35);
        }
        .btn-cek:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(37,99,235,.45); }
        .btn-cek:active { transform: translateY(0); }

        /* ===== ERROR / NOT FOUND ===== */
        .alert-notfound {
            margin-top: 18px;
            background: #fef2f2;
            border: 1.5px solid #fca5a5;
            border-radius: 14px;
            padding: 14px 16px;
            display: flex; align-items: center; gap: 12px;
        }
        .alert-notfound .alert-icon { flex-shrink: 0; color: #ef4444; }
        .alert-notfound p { font-size: 13.5px; color: #991b1b; font-weight: 600; }

        /* ===== RESULT CARD ===== */
        .result-card {
            width: 100%; max-width: 520px;
            margin-top: 20px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,.2);
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.3);
        }

        /* Status Header */
        .status-header {
            padding: 22px 24px;
            display: flex; align-items: center; gap: 16px;
        }
        .status-header.proses   { background: linear-gradient(135deg, #d97706, #f59e0b); }
        .status-header.selesai  { background: linear-gradient(135deg, #059669, #10b981); }
        .status-header.diambil  { background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .status-header.diantar  { background: linear-gradient(135deg, #7c3aed, #8b5cf6); }

        .status-icon-wrap {
            width: 52px; height: 52px; flex-shrink: 0;
            background: rgba(255,255,255,.2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
        }
        .status-icon-wrap svg { width: 28px; height: 28px; color: white; }
        .status-header-text h3 { font-size: 20px; font-weight: 900; color: white; }
        .status-header-text p  { font-size: 12px; color: rgba(255,255,255,.75); font-weight: 600; margin-top: 2px; }
        .nota-badge {
            margin-left: auto; flex-shrink: 0;
            background: rgba(255,255,255,.2);
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 13px; font-weight: 900; color: white;
            font-family: monospace; letter-spacing: 1px;
        }

        /* Info Grid */
        .info-body { padding: 20px 24px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
        .info-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #f1f5f9;
        }
        .info-item.full { grid-column: 1 / -1; }
        .info-label { font-size: 10px; font-weight: 800; color: #94a3b8; letter-spacing: 1.2px; text-transform: uppercase; margin-bottom: 4px; }
        .info-value { font-size: 14px; font-weight: 700; color: #1e293b; }
        .info-value.mono { font-family: monospace; font-size: 13px; }

        /* Progress Steps */
        .progress-section { padding: 0 24px 20px; }
        .progress-title { font-size: 11px; font-weight: 800; color: #94a3b8; letter-spacing: 1.2px; text-transform: uppercase; margin-bottom: 14px; }
        .steps { display: flex; align-items: center; }
        .step { flex: 1; display: flex; flex-direction: column; align-items: center; position: relative; }
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px; left: 50%;
            width: 100%; height: 2px;
            background: #e2e8f0;
            z-index: 0;
        }
        .step.done:not(:last-child)::after { background: #10b981; }
        .step-dot {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 800;
            border: 2px solid #e2e8f0;
            background: white;
            color: #94a3b8;
            position: relative; z-index: 1;
            transition: all .3s;
        }
        .step.done .step-dot {
            background: #10b981; border-color: #10b981; color: white;
            box-shadow: 0 4px 12px rgba(16,185,129,.3);
        }
        .step.active .step-dot {
            background: #2563eb; border-color: #2563eb; color: white;
            box-shadow: 0 4px 12px rgba(37,99,235,.4);
            animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%,100%{box-shadow:0 4px 12px rgba(37,99,235,.4)} 50%{box-shadow:0 4px 20px rgba(37,99,235,.7)} }
        .step-label { font-size: 10px; font-weight: 700; color: #94a3b8; margin-top: 6px; text-align: center; }
        .step.done .step-label, .step.active .step-label { color: #1e293b; }

        /* Bayar Badge */
        .bayar-row {
            display: flex; align-items: center; justify-content: space-between;
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 16px;
            margin: 0 24px 20px;
            border: 1px solid #f1f5f9;
        }
        .bayar-label { font-size: 12px; font-weight: 700; color: #64748b; }
        .bayar-amount { font-size: 20px; font-weight: 900; color: #1e293b; font-family: monospace; }
        .badge-lunas { background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; border: 1px solid #a7f3d0; }
        .badge-belum { background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; border: 1px solid #fca5a5; }

        /* Footer CTA */
        .result-footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }
        .footer-info { font-size: 12px; color: #94a3b8; }
        .btn-cek-lagi {
            font-size: 12px; font-weight: 700; color: #2563eb;
            text-decoration: none;
            background: #dbeafe;
            border-radius: 8px;
            padding: 7px 14px;
            transition: all .2s;
        }
        .btn-cek-lagi:hover { background: #2563eb; color: white; }

        /* ===== FOOTER ===== */
        .page-footer {
            margin-top: 32px;
            text-align: center;
            color: rgba(147,197,253,.5);
            font-size: 12px; font-weight: 600;
        }

        @media (max-width: 480px) {
            .info-grid { grid-template-columns: 1fr; }
            .card-body { padding: 20px; }
            .info-body { padding: 16px 20px; }
            .progress-section { padding: 0 20px 16px; }
            .bayar-row { margin: 0 20px 16px; }
            .result-footer { padding: 14px 20px; }
        }
    </style>
</head>
<body>
    <!-- Background Effects -->
    <div class="bubbles" id="bubbles"></div>
    <div class="grid-overlay"></div>

    <div class="wrapper">
        <!-- Brand -->
        <div class="brand" data-aos="fade-down">
            <div class="brand-logo">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h1>AWAN<span>-LAUNDRY</span></h1>
            <p>CEK STATUS CUCIAN ONLINE</p>
        </div>

        <!-- Search Card -->
        <div class="search-card" data-aos="zoom-in" data-aos-delay="150">
            <div class="card-top-bar"></div>
            <div class="card-body">
                <div class="card-title">
                    <div class="icon">
                        <svg width="18" height="18" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    Lacak Cucian Kamu
                </div>
                <p class="card-desc">Masukkan nomor nota yang kamu dapat saat menitipkan cucian. Misalnya: <strong>TRX-20250501-0001</strong></p>

                <form action="{{ route('cek.status') }}" method="GET">
                    <div class="input-group">
                        <label>Nomor Nota / Kode Cucian</label>
                        <div class="input-wrap">
                            <div class="input-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <input type="text" name="nota" value="{{ $nota ?? '' }}"
                                placeholder="Contoh: TRX-20250501-0001"
                                autocomplete="off" autocapitalize="characters"
                                spellcheck="false" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-cek">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        CEK STATUS SEKARANG
                    </button>
                </form>

                @if(isset($pesan) && $pesan)
                <div class="alert-notfound">
                    <div class="alert-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p>{{ $pesan }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- ===== RESULT ===== --}}
        @if(isset($transaksi) && $transaksi)
        @php
            $sp = strtolower($transaksi->status_pesanan);
            $butuhKurir = $transaksi->butuh_kurir;
            $steps = ['proses', 'selesai', $butuhKurir ? 'diantar' : 'diambil'];
            $stepIdx = array_search($sp, $steps);

            $statusLabel = $transaksi->status_pesanan_label;
            $statusDesc = $transaksi->status_pesanan_deskripsi;

            $stepLabels = ['Dicuci', $butuhKurir ? 'Siap Dikirim' : 'Siap Diambil', $butuhKurir ? 'Dikirim' : 'Diambil'];
            $rincian = $transaksi->rincian_layanan;

            $statusIcons = [
                'proses'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
                'selesai' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                'diambil' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>',
                'diantar' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>',
            ];
        @endphp

        <div class="result-card" data-aos="fade-up" data-aos-delay="100">
            <!-- Status Header -->
            <div class="status-header {{ $sp }}">
                <div class="status-icon-wrap">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        {!! $statusIcons[$sp] ?? $statusIcons['proses'] !!}
                    </svg>
                </div>
                <div class="status-header-text">
                    <h3>{{ $statusLabel }}</h3>
                    <p>{{ $statusDesc }}</p>
                </div>
                <div class="nota-badge">#{{ $transaksi->no_nota }}</div>
            </div>

            <!-- Info Grid -->
            <div class="info-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Pelanggan</div>
                        <div class="info-value">{{ $transaksi->pelanggan->nama_pelanggan }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal Masuk</div>
                        <div class="info-value">{{ $transaksi->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="info-item full">
                        <div class="info-label">Rincian Layanan</div>
                        @foreach($rincian as $detail)
                        <div class="info-value" style="display:flex;justify-content:space-between;gap:12px;padding:3px 0;">
                            <span>{{ $detail->layanan->nama_layanan ?? '-' }}</span>
                            <span>{{ $detail->jumlah_label }} {{ $detail->satuan_label }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="info-item full">
                        <div class="info-label">Metode Pengambilan</div>
                        <div class="info-value">
                            {{ $transaksi->jenis_pengambilan_label }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="progress-section">
                <div class="progress-title">Progress Cucian</div>
                <div class="steps">
                    @foreach($steps as $i => $step)
                    <div class="step {{ $i < $stepIdx ? 'done' : ($i === $stepIdx ? 'active' : '') }}">
                        <div class="step-dot">
                            @if($i < $stepIdx)
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            @elseif($i === $stepIdx)
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><circle cx="12" cy="12" r="4" fill="white"/></svg>
                            @else
                            {{ $i + 1 }}
                            @endif
                        </div>
                        <div class="step-label">{{ $stepLabels[$i] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Bayar -->
            <div class="bayar-row">
                <div>
                    <div class="bayar-label">Total Tagihan</div>
                    <div class="bayar-amount">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</div>
                </div>
                <span class="{{ $transaksi->status_pembayaran === 'lunas' ? 'badge-lunas' : 'badge-belum' }}">
                    {{ $transaksi->status_pembayaran === 'lunas' ? '✅ LUNAS' : '💳 BELUM LUNAS' }}
                </span>
            </div>

            <!-- Footer -->
            <div class="result-footer">
                <div class="footer-info">Diperbarui: {{ $transaksi->updated_at->diffForHumans() }}</div>
                <a href="{{ route('cek.status') }}" class="btn-cek-lagi">🔍 Cek Nota Lain</a>
            </div>
        </div>
        @endif

        <!-- Page Footer -->
        <div class="page-footer" data-aos="fade-up" data-aos-delay="300">
            &copy; {{ date('Y') }} Awan Laundry Express — Semua hak dilindungi
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic' });

        // Generate bubbles
        const container = document.getElementById('bubbles');
        for (let i = 0; i < 20; i++) {
            const b = document.createElement('div');
            b.classList.add('bubble');
            const size = Math.random() * 70 + 20;
            b.style.cssText = `
                width:${size}px; height:${size}px;
                left:${Math.random()*100}%;
                animation-duration:${Math.random()*10+8}s;
                animation-delay:${Math.random()*8}s;
            `;
            container.appendChild(b);
        }
    </script>
</body>
</html>
