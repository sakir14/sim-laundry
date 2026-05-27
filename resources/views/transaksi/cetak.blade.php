<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota #{{ $transaksi->no_nota }}</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px;
            min-height: 100vh;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 360px;
        }
        .btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn:hover { transform: translateY(-1px); opacity: 0.9; }
        .btn-back { background: white; color: #374151; border: 1.5px solid #e5e7eb; }
        .btn-print { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; box-shadow: 0 4px 12px rgba(37,99,235,0.3); }

        /* Struk Wrapper */
        .struk-wrapper {
            width: 100%;
            max-width: 360px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 4px 16px rgba(0,0,0,0.08);
            overflow: hidden;
            position: relative;
        }

        /* Header Gradient */
        .struk-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #1d4ed8 100%);
            padding: 24px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .struk-header::before {
            content: '';
            position: absolute;
            top: -40%; left: -20%;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .struk-header::after {
            content: '';
            position: absolute;
            bottom: -40%; right: -10%;
            width: 150px; height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .struk-logo {
            position: relative;
            z-index: 1;
        }
        .struk-logo h1 {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 2px;
        }
        .struk-logo h1 span { color: #93c5fd; }
        .struk-logo p {
            font-size: 11px;
            color: #bfdbfe;
            margin-top: 3px;
            letter-spacing: 0.5px;
        }
        .struk-logo .address {
            font-size: 10.5px;
            color: #93c5fd;
            margin-top: 8px;
            line-height: 1.5;
        }

        /* Notch (jagged edges) */
        .notch {
            height: 20px;
            background: white;
            position: relative;
        }
        .notch::before {
            content: '';
            position: absolute;
            top: 0; left: -10px;
            width: calc(100% + 20px);
            height: 20px;
            background: #f1f5f9;
            border-radius: 0 0 50% 50% / 0 0 100% 100%;
            background-image: radial-gradient(circle at 10px 0, #f1f5f9 10px, transparent 11px),
                              radial-gradient(circle at calc(100% - 10px) 0, #f1f5f9 10px, transparent 11px);
        }

        /* Body */
        .struk-body { padding: 4px 20px 20px; }

        /* Nota Info */
        .nota-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 14px;
            border: 1px solid #e2e8f0;
        }
        .nota-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3px 0;
            font-size: 12px;
        }
        .nota-row .label { color: #64748b; font-weight: 500; }
        .nota-row .value { color: #1e293b; font-weight: 700; }
        .nota-row .nota-num { color: #2563eb; font-family: monospace; font-weight: 900; font-size: 14px; }

        /* Divider dashed */
        .dash-line {
            border: none;
            border-top: 2px dashed #e2e8f0;
            margin: 14px 0;
        }

        /* Pelanggan */
        .section-label {
            font-size: 10px;
            font-weight: 800;
            color: #94a3b8;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .pelanggan-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }
        .pelanggan-avatar {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 900; font-size: 15px;
            flex-shrink: 0;
        }
        .pelanggan-name { font-size: 14px; font-weight: 800; color: #1e293b; }
        .pelanggan-hp { font-size: 11px; color: #64748b; font-family: monospace; }

        /* Items */
        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            font-size: 12.5px;
        }
        .item-name { font-weight: 600; color: #334155; line-height: 1.4; }
        .item-sub { font-size: 11px; color: #94a3b8; margin-top: 1px; }
        .item-price { font-weight: 800; color: #1e293b; white-space: nowrap; margin-left: 8px; }

        /* Total Box */
        .total-box {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            border-radius: 14px;
            padding: 14px 16px;
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-label { font-size: 12px; font-weight: 800; color: #bfdbfe; letter-spacing: 1px; text-transform: uppercase; }
        .total-amount { font-size: 20px; font-weight: 900; color: white; font-family: monospace; }

        /* Status Badges */
        .status-row {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }
        .badge {
            flex: 1;
            text-align: center;
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-lunas { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .badge-belum { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-status { background: #dbeafe; color: #1d4ed8; border: 1px solid #93c5fd; }

        /* Footer */
        .struk-footer {
            text-align: center;
            padding: 14px 20px 20px;
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.7;
        }
        .struk-footer .thank-you { font-size: 13px; font-weight: 800; color: #334155; margin-bottom: 4px; }

        /* Zigzag cut line */
        .cut-line {
            margin: 0 -20px;
            height: 16px;
            background-image: radial-gradient(circle at 8px 8px, #f1f5f9 8px, transparent 9px);
            background-size: 16px 16px;
            background-repeat: repeat-x;
            background-position: 0 0;
        }

        @media print {
            body { background: white; padding: 0; }
            .action-bar { display: none !important; }
            .struk-wrapper {
                border-radius: 0;
                box-shadow: none;
                max-width: 80mm;
                margin: 0;
            }
            .notch::before { background: white; }
        }
    </style>
</head>
<body>
    <!-- Action Buttons -->
    <div class="action-bar no-print">
        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-back">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <button onclick="window.print()" class="btn btn-print">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Nota
        </button>
    </div>

    <!-- Struk -->
    <div class="struk-wrapper">
        <!-- Header -->
        <div class="struk-header">
            <div class="struk-logo">
                <h1>AWAN<span>-LAUNDRY</span></h1>
                <p>LAUNDRY EXPRESS & PREMIUM</p>
                <p class="address">
                    Jl. Raya Lohbener, Kec. Lohbener, Kab. Indramayu<br>
                    📞 0812-3456-7890 · WA: 0812-3456-7890
                </p>
            </div>
        </div>

        <!-- Notch Top -->
        <div class="notch"></div>

        <!-- Body -->
        <div class="struk-body">
            @php
                $rincian = $transaksi->rincian_layanan;
            @endphp

            <!-- Nota Info -->
            <div class="nota-info">
                <div class="nota-row">
                    <span class="label">No. Nota</span>
                    <span class="nota-num">#{{ $transaksi->no_nota }}</span>
                </div>
                <div class="nota-row">
                    <span class="label">Tanggal</span>
                    <span class="value">{{ $transaksi->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="nota-row">
                    <span class="label">Kasir</span>
                    <span class="value">{{ $transaksi->user->name }}</span>
                </div>
            </div>

            <!-- Pelanggan -->
            <p class="section-label">Pelanggan</p>
            <div class="pelanggan-box">
                <div class="pelanggan-avatar">{{ strtoupper(substr($transaksi->pelanggan->nama_pelanggan, 0, 1)) }}</div>
                <div>
                    <p class="pelanggan-name">{{ $transaksi->pelanggan->nama_pelanggan }}</p>
                    <p class="pelanggan-hp">{{ $transaksi->pelanggan->no_hp }}</p>
                </div>
            </div>

            <hr class="dash-line">

            <!-- Item -->
            <p class="section-label">Rincian Layanan</p>
            @foreach($rincian as $detail)
            <div class="item-row">
                <div>
                    <p class="item-name">{{ $detail->layanan->nama_layanan ?? '-' }}</p>
                    <p class="item-sub">{{ $detail->jumlah_label }} {{ $detail->satuan_label }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                </div>
                <span class="item-price">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach

            @if($transaksi->butuh_kurir)
            <div class="item-row">
                <div>
                    <p class="item-name">{{ $transaksi->jenis_pengambilan_label }}</p>
                    @if($transaksi->alamat_pengiriman)
                    <p class="item-sub">{{ Str::limit($transaksi->alamat_pengiriman, 35) }}</p>
                    @endif
                </div>
                <span class="item-price">Rp {{ number_format($transaksi->biaya_ongkir, 0, ',', '.') }}</span>
            </div>
            @else
            <div class="item-row">
                <div><p class="item-name" style="color:#64748b;font-style:italic;">{{ $transaksi->jenis_pengambilan_label }}</p></div>
                <span class="item-price" style="color:#64748b;">-</span>
            </div>
            @endif

            <!-- Total -->
            <div class="total-box">
                <div>
                    <p class="total-label">Total Tagihan</p>
                </div>
                <p class="total-amount">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
            </div>

            <!-- Status Badges -->
            <div class="status-row">
                <div class="badge {{ $transaksi->status_pembayaran === 'lunas' ? 'badge-lunas' : 'badge-belum' }}">
                    {{ $transaksi->status_pembayaran === 'lunas' ? ' LUNAS' : ' BELUM LUNAS' }}
                </div>
                <div class="badge badge-status">
                     {{ strtoupper($transaksi->status_pesanan) }}
                </div>
            </div>
        </div>

        <!-- Zigzag cut line -->
        <div style="padding: 0 20px;"><div class="cut-line"></div></div>

        <!-- Footer -->
        <div class="struk-footer">
            <p class="thank-you">Terima kasih telah mempercayai kami! </p>
            <p>"Cucian bersih, hati pun senang."</p>
            <p style="margin-top:6px; font-size:10px;">Simpan nota ini sebagai bukti transaksi Anda</p>
        </div>
    </div>
</body>
</html>
