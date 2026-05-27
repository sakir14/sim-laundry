<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" data-aos="fade-right">
            <a href="{{ route('transaksi.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800">Transaksi Baru</h2>
                <p class="text-sm text-slate-500 mt-0.5">Input data cucian masuk dengan beberapa layanan dalam satu nota</p>
            </div>
        </div>
    </x-slot>

    @php
        $oldItems = old('items', [['layanan_id' => '', 'jumlah' => '']]);

        if (!is_array($oldItems) || count($oldItems) === 0) {
            $oldItems = [['layanan_id' => '', 'jumlah' => '']];
        }

        $oldItems = array_values($oldItems);
    @endphp

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-sm text-red-700 font-semibold">
                Data transaksi belum lengkap. Periksa kembali pelanggan, layanan, jumlah, dan pembayaran.
            </div>
            @endif

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                    <!-- Kiri: Data Pelanggan & Layanan -->
                    <div class="space-y-4" data-aos="fade-right" data-aos-delay="100">

                        <!-- No Nota -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                            <h4 class="text-sm font-bold text-slate-700 flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                                </div>
                                Nomor Nota
                            </h4>
                            <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-xl px-4 py-3 flex items-center gap-3">
                                <span class="text-xs text-slate-400 font-medium">No. Nota:</span>
                                <span class="font-mono font-black text-blue-600 text-lg tracking-wider">{{ $no_nota }}</span>
                                <input type="hidden" name="no_nota" value="{{ $no_nota }}">
                            </div>
                        </div>

                        <!-- Data Pelanggan -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                            <h4 class="text-sm font-bold text-slate-700 flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                Data Pelanggan
                            </h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" class="input-modern" placeholder="Contoh: 081234..." autocomplete="off" required>
                                    <p class="text-[11px] text-slate-400 mt-1">*Jika No. HP sudah terdaftar, sistem otomatis mengenalinya</p>
                                    <p id="pelanggan-lookup-status" class="text-[11px] text-slate-400 mt-1 font-semibold"></p>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="input-modern" required placeholder="Nama lengkap pelanggan">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Alamat <span class="text-red-500">*</span></label>
                                    <textarea name="alamat" id="alamat" rows="2" class="input-modern resize-none" required placeholder="Alamat lengkap pelanggan">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Pilih Layanan -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <h4 class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                    <div class="w-6 h-6 bg-amber-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </div>
                                    Rincian Layanan
                                </h4>
                                <button type="button" onclick="addItem()" class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-xl text-xs font-bold transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    Tambah Layanan
                                </button>
                            </div>

                            <div id="items-wrapper" class="space-y-3">
                                @foreach($oldItems as $index => $item)
                                <div class="layanan-row rounded-xl border border-slate-200 bg-slate-50 p-3" data-item-row>
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs font-black text-slate-500 uppercase tracking-wider">Layanan <span data-item-number>{{ $loop->iteration }}</span></p>
                                        <button type="button" onclick="removeItem(this)" class="remove-item-btn text-red-500 hover:text-red-700 text-xs font-bold">Hapus</button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                                        <div class="md:col-span-6">
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Paket <span class="text-red-500">*</span></label>
                                            <select name="items[{{ $index }}][layanan_id]" class="input-modern text-sm layanan-select" required onchange="handleLayananChange(this)">
                                                <option value="" data-harga="0" data-satuan="unit">-- Pilih Paket Layanan --</option>
                                                @foreach($layanans as $l)
                                                <option value="{{ $l->id }}" data-harga="{{ $l->harga }}" data-satuan="{{ $l->satuan }}" @selected(($item['layanan_id'] ?? '') == $l->id)>
                                                    {{ $l->nama_layanan }} - Rp {{ number_format($l->harga,0,',','.') }}/{{ $l->satuan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="md:col-span-3">
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Berat / Jumlah <span class="text-red-500">*</span></label>
                                            <div class="flex">
                                                <input type="number" name="items[{{ $index }}][jumlah]" value="{{ $item['jumlah'] ?? '' }}" step="0.1" min="0.1" class="input-modern rounded-r-none jumlah-input" oninput="hitungTotal()" required placeholder="0.0">
                                                <span class="unit-label inline-flex items-center px-3 rounded-r-xl border border-l-0 border-slate-200 bg-white text-xs font-black text-slate-500">UNIT</span>
                                            </div>
                                        </div>
                                        <div class="md:col-span-3">
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Subtotal</label>
                                            <div class="h-[46px] rounded-xl bg-white border border-slate-200 px-3 flex items-center justify-end">
                                                <span class="subtotal-item font-mono font-black text-slate-800 text-sm">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <template id="item-template">
                                <div class="layanan-row rounded-xl border border-slate-200 bg-slate-50 p-3" data-item-row>
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs font-black text-slate-500 uppercase tracking-wider">Layanan <span data-item-number></span></p>
                                        <button type="button" onclick="removeItem(this)" class="remove-item-btn text-red-500 hover:text-red-700 text-xs font-bold">Hapus</button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                                        <div class="md:col-span-6">
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Paket <span class="text-red-500">*</span></label>
                                            <select name="items[__INDEX__][layanan_id]" class="input-modern text-sm layanan-select" required onchange="handleLayananChange(this)">
                                                <option value="" data-harga="0" data-satuan="unit">-- Pilih Paket Layanan --</option>
                                                @foreach($layanans as $l)
                                                <option value="{{ $l->id }}" data-harga="{{ $l->harga }}" data-satuan="{{ $l->satuan }}">
                                                    {{ $l->nama_layanan }} - Rp {{ number_format($l->harga,0,',','.') }}/{{ $l->satuan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="md:col-span-3">
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Berat / Jumlah <span class="text-red-500">*</span></label>
                                            <div class="flex">
                                                <input type="number" name="items[__INDEX__][jumlah]" step="0.1" min="0.1" class="input-modern rounded-r-none jumlah-input" oninput="hitungTotal()" required placeholder="0.0">
                                                <span class="unit-label inline-flex items-center px-3 rounded-r-xl border border-l-0 border-slate-200 bg-white text-xs font-black text-slate-500">UNIT</span>
                                            </div>
                                        </div>
                                        <div class="md:col-span-3">
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Subtotal</label>
                                            <div class="h-[46px] rounded-xl bg-white border border-slate-200 px-3 flex items-center justify-end">
                                                <span class="subtotal-item font-mono font-black text-slate-800 text-sm">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Kanan: Pengiriman & Pembayaran -->
                    <div class="space-y-4" data-aos="fade-left" data-aos-delay="150">

                        <!-- Metode Pengambilan -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                            <h4 class="text-sm font-bold text-slate-700 flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 bg-violet-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                </div>
                                Metode Pengambilan
                            </h4>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Metode <span class="text-red-500">*</span></label>
                                <select name="jenis_pengambilan" id="jenis_pengambilan" class="input-modern" required onchange="togglePengiriman()">
                                    <option value="ambil_sendiri" @selected(old('jenis_pengambilan') === 'ambil_sendiri')>Pelanggan Ambil Sendiri</option>
                                    <option value="antar" @selected(old('jenis_pengambilan') === 'antar')>Diantar oleh Kurir</option>
                                    <option value="antar_jemput" @selected(old('jenis_pengambilan') === 'antar_jemput')>Antar & Jemput oleh Kurir</option>
                                </select>
                            </div>

                            <!-- Form Pengiriman -->
                            <div id="form_pengiriman" class="hidden mt-4 p-4 bg-amber-50 border border-amber-200 rounded-xl space-y-3">
                                <p class="text-xs font-bold text-amber-700 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                    Detail Kurir
                                </p>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Alamat Kurir</label>
                                    <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="2" class="input-modern resize-none" placeholder="Alamat antar / jemput kurir">{{ old('alamat_pengiriman') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Biaya Ongkir (Rp)</label>
                                    <input type="number" name="biaya_ongkir" id="biaya_ongkir" value="{{ old('biaya_ongkir', 0) }}" min="0" class="input-modern" oninput="hitungTotal()">
                                </div>
                            </div>
                        </div>

                        <!-- Status Pembayaran -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                            <h4 class="text-sm font-bold text-slate-700 flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                Status Pembayaran
                            </h4>
                            <select name="status_pembayaran" class="input-modern" required>
                                <option value="belum_lunas" @selected(old('status_pembayaran') === 'belum_lunas')>Belum Lunas (Bayar Nanti)</option>
                                <option value="lunas" @selected(old('status_pembayaran') === 'lunas')>Lunas (Bayar Sekarang)</option>
                            </select>
                        </div>

                        <!-- TOTAL BAYAR -->
                        <div class="rounded-2xl p-5 shadow-lg" style="background: linear-gradient(135deg, #1d4ed8, #2563eb);">
                            <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-2">Total Tagihan</p>
                            <div class="bg-white/15 rounded-xl px-4 py-3 mb-3">
                                <p id="total_bayar_display" class="text-3xl font-black text-white">Rp 0</p>
                                <input type="hidden" name="total_bayar" id="total_bayar" value="0">
                            </div>
                            <div class="space-y-1 text-xs text-blue-200">
                                <div class="flex justify-between">
                                    <span><span id="item-count">1</span> layanan</span>
                                    <span id="sub-layanan" class="font-bold">Rp 0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Biaya Ongkir</span>
                                    <span id="sub-ongkir" class="font-bold">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('transaksi.index') }}" class="btn-secondary flex-1 justify-center text-sm">
                                Batal
                            </a>
                            <button type="submit" class="btn-primary flex-1 justify-center text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Simpan Transaksi
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        let itemIndex = {{ count($oldItems) }};
        const pelangganLookupUrl = @json(route('pelanggan.lookup'));
        let pelangganLookupTimer = null;
        let lastAutofilled = null;

        function formatRupiah(value) {
            return 'Rp ' + Math.round(value || 0).toLocaleString('id-ID');
        }

        function normalizePhone(value) {
            return (value || '').replace(/\D/g, '');
        }

        function setLookupStatus(message, colorClass = 'text-slate-400') {
            const status = document.getElementById('pelanggan-lookup-status');

            if (!status) {
                return;
            }

            status.textContent = message;
            status.className = `text-[11px] ${colorClass} mt-1 font-semibold`;
        }

        function clearAutofillIfPhoneChanged(phone) {
            if (!lastAutofilled || normalizePhone(phone) === normalizePhone(lastAutofilled.no_hp)) {
                return;
            }

            const namaInput = document.getElementById('nama_pelanggan');
            const alamatInput = document.getElementById('alamat');
            const alamatPengirimanInput = document.getElementById('alamat_pengiriman');

            if (namaInput.value === lastAutofilled.nama_pelanggan) {
                namaInput.value = '';
            }

            if (alamatInput.value === lastAutofilled.alamat) {
                alamatInput.value = '';
            }

            if (alamatPengirimanInput && alamatPengirimanInput.value === lastAutofilled.alamat) {
                alamatPengirimanInput.value = '';
            }

            lastAutofilled = null;
        }

        async function lookupPelangganByPhone() {
            const noHpInput = document.getElementById('no_hp');
            const namaInput = document.getElementById('nama_pelanggan');
            const alamatInput = document.getElementById('alamat');
            const alamatPengirimanInput = document.getElementById('alamat_pengiriman');
            const noHp = noHpInput.value.trim();
            const normalizedNoHp = normalizePhone(noHp);

            clearAutofillIfPhoneChanged(noHp);

            if (normalizedNoHp.length < 6) {
                setLookupStatus('');
                return;
            }

            setLookupStatus('Mencari data pelanggan...', 'text-blue-500');

            try {
                const response = await fetch(`${pelangganLookupUrl}?no_hp=${encodeURIComponent(noHp)}`, {
                    headers: { Accept: 'application/json' },
                });

                if (!response.ok) {
                    throw new Error('Gagal mencari pelanggan');
                }

                const data = await response.json();

                if (!data.found) {
                    setLookupStatus('Pelanggan belum terdaftar. Silakan isi nama dan alamat.', 'text-slate-500');
                    return;
                }

                namaInput.value = data.pelanggan.nama_pelanggan || '';
                alamatInput.value = data.pelanggan.alamat || '';

                if (alamatPengirimanInput && !alamatPengirimanInput.value) {
                    alamatPengirimanInput.value = data.pelanggan.alamat || '';
                }

                lastAutofilled = data.pelanggan;
                setLookupStatus('Pelanggan ditemukan. Nama dan alamat terisi otomatis.', 'text-emerald-600');
            } catch (error) {
                setLookupStatus('Data pelanggan belum bisa dicek. Isi manual jika diperlukan.', 'text-red-500');
            }
        }

        function schedulePelangganLookup() {
            clearTimeout(pelangganLookupTimer);
            pelangganLookupTimer = setTimeout(lookupPelangganByPhone, 450);
        }

        function togglePengiriman() {
            const jenis = document.getElementById('jenis_pengambilan').value;
            const formKirim = document.getElementById('form_pengiriman');

            if (jenis === 'antar' || jenis === 'antar_jemput') {
                formKirim.classList.remove('hidden');
            } else {
                formKirim.classList.add('hidden');
                document.getElementById('biaya_ongkir').value = 0;
                document.getElementById('alamat_pengiriman').value = '';
                hitungTotal();
            }
        }

        function handleLayananChange(select) {
            const row = select.closest('[data-item-row]');
            const satuan = select.options[select.selectedIndex]?.dataset.satuan || 'unit';
            const jumlahInput = row.querySelector('.jumlah-input');
            const unitLabel = row.querySelector('.unit-label');

            unitLabel.textContent = satuan.toUpperCase();
            jumlahInput.step = satuan === 'pcs' ? '1' : '0.1';
            jumlahInput.placeholder = satuan === 'pcs' ? '1' : '0.0';

            hitungTotal();
        }

        function addItem() {
            const wrapper = document.getElementById('items-wrapper');
            const template = document.getElementById('item-template').innerHTML.replaceAll('__INDEX__', itemIndex);

            wrapper.insertAdjacentHTML('beforeend', template);
            itemIndex++;
            refreshRows();
            hitungTotal();
        }

        function removeItem(button) {
            const rows = document.querySelectorAll('[data-item-row]');

            if (rows.length <= 1) {
                return;
            }

            button.closest('[data-item-row]').remove();
            refreshRows();
            hitungTotal();
        }

        function refreshRows() {
            const rows = document.querySelectorAll('[data-item-row]');

            rows.forEach((row, index) => {
                row.querySelector('[data-item-number]').textContent = index + 1;
                const removeButton = row.querySelector('.remove-item-btn');
                removeButton.disabled = rows.length <= 1;
                removeButton.classList.toggle('opacity-40', rows.length <= 1);
                removeButton.classList.toggle('cursor-not-allowed', rows.length <= 1);
                handleLayananChange(row.querySelector('.layanan-select'));
            });

            document.getElementById('item-count').textContent = rows.length;
        }

        function hitungTotal() {
            let subLayanan = 0;

            document.querySelectorAll('[data-item-row]').forEach((row) => {
                const selectLayanan = row.querySelector('.layanan-select');
                const hargaLayanan = parseFloat(selectLayanan.options[selectLayanan.selectedIndex]?.dataset.harga) || 0;
                const jumlah = parseFloat(row.querySelector('.jumlah-input').value) || 0;
                const subtotal = hargaLayanan * jumlah;

                subLayanan += subtotal;
                row.querySelector('.subtotal-item').textContent = formatRupiah(subtotal);
            });

            const ongkir = parseFloat(document.getElementById('biaya_ongkir').value) || 0;
            const total = subLayanan + ongkir;

            document.getElementById('total_bayar_display').textContent = formatRupiah(total);
            document.getElementById('total_bayar').value = Math.round(total);
            document.getElementById('sub-layanan').textContent = formatRupiah(subLayanan);
            document.getElementById('sub-ongkir').textContent = formatRupiah(ongkir);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const noHpInput = document.getElementById('no_hp');

            if (noHpInput) {
                noHpInput.addEventListener('input', schedulePelangganLookup);
                noHpInput.addEventListener('blur', lookupPelangganByPhone);

                if (noHpInput.value.trim() !== '') {
                    lookupPelangganByPhone();
                }
            }

            refreshRows();
            togglePengiriman();
            hitungTotal();
        });
    </script>
    @endpush
</x-app-layout>
