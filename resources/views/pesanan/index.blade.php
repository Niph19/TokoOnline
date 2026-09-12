@extends('layouts.store')

@section('content')
<section class="container section-block"><p class="eyebrow">AKUN PEMBELI</p><h1>Pesanan saya</h1>
    @if ($pesanans->isEmpty())<div class="empty-state">Belum ada pesanan. <a href="{{ route('landing') }}">Lihat katalog</a></div>@else
    <div class="order-list">@foreach ($pesanans as $pesanan)<a class="order-row" href="{{ route('pesanan.show', $pesanan->id) }}"><div><strong>#{{ $pesanan->id }} &middot; {{ $pesanan->produk->nama_produk }}</strong><span>{{ $pesanan->created_at->format('d M Y') }} &middot; {{ $pesanan->kuantitas }} item</span></div><div class="order-row__right"><span class="status status--{{ strtolower(str_replace(' ', '-', $pesanan->status)) }}">{{ $pesanan->status }}</span><strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></div></a>@endforeach</div>{{ $pesanans->links() }}@endif
</section>
@endsection
