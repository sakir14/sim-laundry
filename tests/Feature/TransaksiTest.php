<?php

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;

test('transaksi can contain kiloan and satuan layanan in one nota', function () {
    $user = User::factory()->create();

    $kiloan = Layanan::create([
        'nama_layanan' => 'Cuci Kiloan',
        'harga' => 7000,
        'satuan' => 'kg',
    ]);

    $sepatu = Layanan::create([
        'nama_layanan' => 'Cuci Sepatu',
        'harga' => 25000,
        'satuan' => 'pcs',
    ]);

    $response = $this->actingAs($user)->post(route('transaksi.store'), [
        'no_nota' => 'TRX-TEST-0001',
        'nama_pelanggan' => 'Budi',
        'no_hp' => '081234567890',
        'alamat' => 'Jl. Mawar No. 1',
        'items' => [
            ['layanan_id' => $kiloan->id, 'jumlah' => 2],
            ['layanan_id' => $sepatu->id, 'jumlah' => 1],
        ],
        'jenis_pengambilan' => 'ambil_sendiri',
        'status_pembayaran' => 'belum_lunas',
    ]);

    $response->assertRedirect(route('transaksi.index', absolute: false));

    $transaksi = Transaksi::with('details')->where('no_nota', 'TRX-TEST-0001')->first();

    expect($transaksi)->not->toBeNull()
        ->and($transaksi->total_bayar)->toBe(39000)
        ->and($transaksi->details)->toHaveCount(2);

    $this->assertDatabaseHas('transaksi_details', [
        'transaksi_id' => $transaksi->id,
        'layanan_id' => $kiloan->id,
        'jumlah' => 2,
        'subtotal' => 14000,
    ]);

    $this->assertDatabaseHas('transaksi_details', [
        'transaksi_id' => $transaksi->id,
        'layanan_id' => $sepatu->id,
        'jumlah' => 1,
        'subtotal' => 25000,
    ]);
});

test('transaksi can use antar jemput method with courier cost', function () {
    $user = User::factory()->create();

    $layanan = Layanan::create([
        'nama_layanan' => 'Cuci Setrika',
        'harga' => 8000,
        'satuan' => 'kg',
    ]);

    $response = $this->actingAs($user)->post(route('transaksi.store'), [
        'no_nota' => 'TRX-TEST-0002',
        'nama_pelanggan' => 'Sari',
        'no_hp' => '081299988877',
        'alamat' => 'Jl. Melati No. 2',
        'items' => [
            ['layanan_id' => $layanan->id, 'jumlah' => 3],
        ],
        'jenis_pengambilan' => 'antar_jemput',
        'alamat_pengiriman' => 'Jl. Melati No. 2',
        'biaya_ongkir' => 10000,
        'status_pembayaran' => 'lunas',
    ]);

    $response->assertRedirect(route('transaksi.index', absolute: false));

    $transaksi = Transaksi::where('no_nota', 'TRX-TEST-0002')->first();

    expect($transaksi)->not->toBeNull()
        ->and($transaksi->jenis_pengambilan)->toBe('antar_jemput')
        ->and($transaksi->butuh_kurir)->toBeTrue()
        ->and($transaksi->jenis_pengambilan_label)->toBe('Antar & Jemput oleh Kurir')
        ->and($transaksi->biaya_ongkir)->toBe(10000)
        ->and($transaksi->total_bayar)->toBe(34000);
});

test('kasir can lookup pelanggan by phone before creating transaksi', function () {
    $user = User::factory()->create();

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'Rina',
        'no_hp' => '081234567777',
        'alamat' => 'Jl. Kenanga No. 7',
    ]);

    $response = $this->actingAs($user)->getJson(route('pelanggan.lookup', [
        'no_hp' => '081234567777',
    ]));

    $response->assertOk()
        ->assertJson([
            'found' => true,
            'pelanggan' => [
                'id' => $pelanggan->id,
                'nama_pelanggan' => 'Rina',
                'no_hp' => '081234567777',
                'alamat' => 'Jl. Kenanga No. 7',
            ],
        ]);
});

test('kasir can search transaksi from daftar cucian masuk', function () {
    $user = User::factory()->create();

    $layanan = Layanan::create([
        'nama_layanan' => 'Cuci Kiloan',
        'harga' => 7000,
        'satuan' => 'kg',
    ]);

    $rina = Pelanggan::create([
        'nama_pelanggan' => 'Rina',
        'no_hp' => '081111111111',
        'alamat' => 'Jl. Kenanga',
    ]);

    $budi = Pelanggan::create([
        'nama_pelanggan' => 'Budi',
        'no_hp' => '082222222222',
        'alamat' => 'Jl. Mawar',
    ]);

    Transaksi::create([
        'no_nota' => 'TRX-CARI-0001',
        'pelanggan_id' => $rina->id,
        'layanan_id' => $layanan->id,
        'user_id' => $user->id,
        'berat' => 2,
        'biaya_ongkir' => 0,
        'total_bayar' => 14000,
        'status_pembayaran' => 'belum_lunas',
        'status_pesanan' => 'proses',
        'jenis_pengambilan' => 'ambil_sendiri',
    ]);

    Transaksi::create([
        'no_nota' => 'TRX-CARI-0002',
        'pelanggan_id' => $budi->id,
        'layanan_id' => $layanan->id,
        'user_id' => $user->id,
        'berat' => 3,
        'biaya_ongkir' => 0,
        'total_bayar' => 21000,
        'status_pembayaran' => 'lunas',
        'status_pesanan' => 'selesai',
        'jenis_pengambilan' => 'ambil_sendiri',
    ]);

    $response = $this->actingAs($user)->get(route('transaksi.index', [
        'search' => 'Rina',
    ]));

    $response->assertOk()
        ->assertSee('TRX-CARI-0001')
        ->assertSee('Ubah Status')
        ->assertDontSee('TRX-CARI-0002');
});

test('courier transaksi uses siap dikirim label when ready', function () {
    $user = User::factory()->create();

    $layanan = Layanan::create([
        'nama_layanan' => 'Cuci Kiloan',
        'harga' => 10000,
        'satuan' => 'kg',
    ]);

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'Sasieng',
        'no_hp' => '083333333333',
        'alamat' => 'Jl. Melati',
    ]);

    $transaksi = Transaksi::create([
        'no_nota' => 'TRX-KIRIM-0001',
        'pelanggan_id' => $pelanggan->id,
        'layanan_id' => $layanan->id,
        'user_id' => $user->id,
        'berat' => 3,
        'biaya_ongkir' => 4999,
        'total_bayar' => 34999,
        'status_pembayaran' => 'belum_lunas',
        'status_pesanan' => 'selesai',
        'jenis_pengambilan' => 'antar_jemput',
        'alamat_pengiriman' => 'Jl. Melati',
    ]);

    expect($transaksi->fresh()->status_pesanan_label)->toBe('Siap Dikirim');

    $this->actingAs($user)
        ->get(route('transaksi.show', $transaksi))
        ->assertOk()
        ->assertSee('Siap Dikirim')
        ->assertDontSee('Siap Diambil');

    $this->get(route('cek.status', ['nota' => $transaksi->no_nota]))
        ->assertOk()
        ->assertSee('Siap Dikirim');
});
