@extends('layouts.store')

@section('content')
    <section class="hero container">
        <div>
            <p class="eyebrow">TOKO KITA / KATALOG</p>
            <h1>Belanja kebutuhanmu dari satu toko.</h1>
            <p class="hero__copy">Pilih produk, isi alamat, lalu pantau pesanan sampai selesai.</p>
        </div>
        <div class="hero__note"><strong>{{ $dataProduk->count() }}</strong><span>produk tersedia</span></div>
    </section>
    <section class="container section-block" aria-labelledby="catalog-title">
        <div class="section-heading">
            <div>
                <p class="eyebrow">KATALOG PRODUK</p>
                <h2 id="catalog-title">Produk pilihan</h2>
            </div>
        </div>
        @if ($dataProduk->isEmpty())
            <div class="empty-state">Belum ada produk yang tersedia.</div>
        @else
            <div class="product-grid">
                @foreach ($dataProduk as $produk)
                    <article class="product-card">
                        <div class="product-card__image">@if ($produk->image)<img src="{{ asset('storage/' . $produk->image) }}"
                        >@else<span>Foto produk</span>@endif</div>
                        <div class="product-card__body">
                            <div class="product-card__meta"><span>{{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}</span><span>Stok
                                    {{ $produk->stok }}</span></div>
                            <h3>{{ $produk->nama_produk }}</h3>
                            <p>{{ $produk->deskripsi }}</p>
                            <div class="product-card__footer"><strong>Rp
                                    {{ number_format($produk->harga, 0, ',', '.') }}</strong>@auth<a class="button button--small"
                                    href="{{ route('pesanan.create', $produk) }}">Checkout</a>@else<a class="button button--small"
                                    href="{{ route('login') }}">Masuk untuk beli</a>@endauth</div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection