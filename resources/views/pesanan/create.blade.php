@extends('layouts.store')

@section('content')
<section class="container section-block narrow-content">
    <p class="eyebrow">CHECKOUT</p><h1>Lengkapi pesanan</h1>
    <div class="checkout-layout">
        <div class="form-panel">
            <form method="POST" action="{{ route('pesanan.store', $produk) }}" enctype="multipart/form-data">
                @csrf
                <label for="alamat_id">Alamat pengiriman</label>
                @if ($alamats->isNotEmpty())
                    <select id="alamat_id" name="alamat_id" required><option value="">Pilih alamat</option>@foreach ($alamats as $alamat)<option value="{{ $alamat->id }}">{{ $alamat->alamat }}, {{ $alamat->kota }}</option>@endforeach</select>
                @else
                    <p class="form-help">Simpan alamat pengiriman untuk pesanan ini.</p>
                    <input id="alamat" name="alamat" placeholder="Alamat lengkap" required><div class="form-grid"><input name="kecamatan" placeholder="Kecamatan" required><input name="kota" placeholder="Kota" required><input name="provinsi" placeholder="Provinsi" required><input name="kode_pos" placeholder="Kode pos" required></div>
                @endif
                <label for="kuantitas">Kuantitas</label><input id="kuantitas" type="number" name="kuantitas" min="1" max="{{ $produk->stok }}" value="1" required>
                <fieldset><legend>Metode pembayaran</legend><label class="choice"><input type="radio" name="tipe" value="cod" checked> COD</label><label class="choice"><input type="radio" name="tipe" value="transfer"> Transfer</label></fieldset>
                <label for="bukti_pembayaran">Bukti pembayaran <span class="muted">(wajib untuk transfer)</span></label><input id="bukti_pembayaran" type="file" name="bukti_pembayaran" accept="image/*">
                @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                <button class="button" type="submit">Buat Pesanan</button>
            </form>
        </div>
        <aside class="summary-panel"><p class="eyebrow">RINGKASAN</p><h2>{{ $produk->nama_produk }}</h2><p>{{ $produk->deskripsi }}</p><strong>Rp {{ number_format($produk->harga, 0, ',', '.') }}</strong></aside>
    </div>
</section>
@endsection
