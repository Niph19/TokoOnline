@extends('layouts.store')

@section('content')
<section class="container section-block narrow-content"><a class="back-link" href="{{ route('pesanan.index') }}">&larr; Kembali ke pesanan</a><p class="eyebrow">DETAIL PESANAN #{{ $pesanan->id }}</p><h1>{{ $pesanan->produk->nama_produk }}</h1><div class="detail-panel"><div class="status status--{{ strtolower(str_replace(' ', '-', $pesanan->status)) }}">{{ $pesanan->status }}</div><dl class="detail-list"><div><dt>Jumlah</dt><dd>{{ $pesanan->kuantitas }} item</dd></div><div><dt>Total</dt><dd>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</dd></div><div><dt>Pembayaran</dt><dd>{{ strtoupper($pesanan->tipe) }}</dd></div><div><dt>Alamat</dt><dd>{{ $pesanan->alamat->alamat }}, {{ $pesanan->alamat->kota }}</dd></div></dl></div></section>
@endsection
