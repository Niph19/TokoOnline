@extends('layouts.store')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1435] text-white relative overflow-hidden">
    <div class="absolute -top-24 -right-32 w-96 h-96 rounded-full bg-[#2451FF]/20"></div>
    <div class="max-w-6xl mx-auto px-5 py-20 flex items-center justify-between gap-8 flex-wrap relative z-10">
        <div class="max-w-xl">
            <span class="inline-flex items-center gap-1.5 text-sm font-medium text-[#8FA3FF] mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-[#8FA3FF]"></span> Satu toko, tanpa ribet
            </span>
            <h1 class="font-['Space_Grotesk'] text-4xl md:text-5xl font-semibold leading-tight mb-4">Belanja jadi ringkas, bukan panjang.</h1>
            <p class="text-white/70 text-base leading-relaxed max-w-md">Pilih produk yang kamu perlu, checkout dalam sekali klik, dan pantau pesanan sampai tiba di depan pintu.</p>
            <a href="#katalog" class="inline-flex items-center gap-2 mt-7 px-5 py-3 bg-[#2451FF] text-white text-sm font-semibold rounded-lg hover:bg-[#3D66FF] transition-colors">
                Lihat Katalog
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>
        <div class="bg-white/10 border border-white/15 backdrop-blur rounded-2xl px-8 py-6 text-center shrink-0">
            <span class="block font-['Space_Grotesk'] text-5xl font-semibold text-white leading-none">{{ $dataProduk->count() }}</span>
            <span class="text-white/60 text-sm mt-1 block">Produk tersedia</span>
        </div>
    </div>
</section>

{{-- Catalog --}}
<section id="katalog" class="max-w-6xl mx-auto px-5 py-16">
    <div class="mb-8">
        <h2 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220]">Produk pilihan</h2>
        <p class="text-[#5B6472] text-sm mt-1">Semua yang tersedia di toko.</p>
    </div>

    @if ($dataProduk->isEmpty())
        <div class="text-center py-20 border-2 border-dashed border-[#E4E8F3] rounded-2xl text-[#8A93A6]">
            Belum ada produk yang tersedia.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($dataProduk as $produk)
                <article class="bg-white border border-[#E4E8F3] rounded-2xl overflow-hidden flex flex-col hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <div class="aspect-[4/3] bg-[#F5F7FF] flex items-center justify-center overflow-hidden">
                        @if ($produk->image)
                            <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-[#8FA3FF] text-sm">Foto produk</span>
                        @endif
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex gap-2 mb-2">
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $produk->stok > 0 ? 'bg-[#EAF7EF] text-[#15803D]' : 'bg-[#FEF2F2] text-[#B91C1C]' }}">
                                {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-[#F5F7FF] text-[#2451FF]">Stok {{ $produk->stok }}</span>
                        </div>
                        <h3 class="font-semibold text-[#0B1220] mb-1">{{ $produk->nama_produk }}</h3>
                        <p class="text-[#5B6472] text-sm leading-relaxed flex-1 mb-4">{{ $produk->deskripsi }}</p>
                        <div class="flex items-center justify-between pt-3 border-t border-[#E4E8F3]">
                            <span class="text-[#2451FF] font-semibold text-lg">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @auth
                                <a href="{{ route('pesanan.create', $produk) }}" class="px-4 py-2 bg-[#2451FF] text-white text-sm font-semibold rounded-lg hover:bg-[#17348F] transition-colors">Checkout</a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-[#2451FF] text-white text-sm font-semibold rounded-lg hover:bg-[#17348F] transition-colors">Masuk untuk beli</a>
                            @endauth
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>

@endsection