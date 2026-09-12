@extends('layouts.admin')
@section('content')
<div class="page-heading"><div><p class="eyebrow">RINGKASAN</p><h1>Selamat datang, {{ Auth::user()->nama_lengkap }}</h1></div><a class="button" href="{{ route('admin.produk.create') }}">Tambah Produk</a></div>
<div class="stat-grid"><div class="stat-card"><span>Total produk</span><strong>{{ $jumlahProduk }}</strong></div><div class="stat-card"><span>Total pesanan</span><strong>{{ $jumlahPesanan }}</strong></div></div>
<section class="admin-panel"><div class="section-heading"><h2>Pesanan terbaru</h2><a href="{{ route('admin.pesanan.index') }}">Lihat semua</a></div><div class="order-list">@forelse ($pesananTerbaru as $pesanan)<div class="order-row"><div><strong>#{{ $pesanan->id }} &middot; {{ $pesanan->produk->nama_produk }}</strong><span>{{ $pesanan->user->nama_lengkap }}</span></div><span class="status">{{ $pesanan->status }}</span></div>@empty<div class="empty-state">Belum ada pesanan.</div>@endforelse</div></section>
@endsection