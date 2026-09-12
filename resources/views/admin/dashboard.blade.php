@extends('layouts.admin')

@section('content')
<div class="flex items-start justify-between gap-4 mb-8">
    <div>
        <span class="text-sm font-medium text-[#5B6472]">Ringkasan</span>
        <h1 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220] mt-0.5">Selamat datang, {{ Auth::user()->nama_lengkap }}</h1>
    </div>
    <a href="{{ route('admin.produk.create') }}" class="px-4 py-2 bg-[#2451FF] text-white text-sm font-semibold rounded-lg hover:bg-[#17348F] transition-colors shrink-0">
        Tambah Produk
    </a>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 gap-4 mb-8">
    <div class="bg-white border border-[#E4E8F3] rounded-2xl p-6">
        <div class="w-9 h-9 bg-[#F5F7FF] rounded-lg flex items-center justify-center text-[#2451FF] mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" /></svg>
        </div>
        <p class="text-[#5B6472] text-sm">Total produk</p>
        <p class="font-['Space_Grotesk'] text-4xl font-semibold text-[#0B1220] mt-1">{{ $jumlahProduk }}</p>
    </div>
    <div class="bg-white border border-[#E4E8F3] rounded-2xl p-6">
        <div class="w-9 h-9 bg-[#F5F7FF] rounded-lg flex items-center justify-center text-[#2451FF] mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
        </div>
        <p class="text-[#5B6472] text-sm">Total pesanan</p>
        <p class="font-['Space_Grotesk'] text-4xl font-semibold text-[#0B1220] mt-1">{{ $jumlahPesanan }}</p>
    </div>
</div>

{{-- Recent orders --}}
<div class="bg-white border border-[#E4E8F3] rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-[#E4E8F3]">
        <h2 class="font-semibold text-[#0B1220]">Pesanan terbaru</h2>
        <a href="{{ route('admin.pesanan.index') }}" class="text-sm text-[#2451FF] font-medium hover:underline">Lihat semua</a>
    </div>
    <div class="divide-y divide-[#E4E8F3]">
        @forelse ($pesananTerbaru as $pesanan)
            @php
                $statusColor = match($pesanan->status) {
                    'Menunggu Pembayaran' => 'bg-[#FEF9C3] text-[#854D0E]',
                    'Diproses'           => 'bg-[#F5F7FF] text-[#2451FF]',
                    'Dikirim'            => 'bg-[#E0F2FE] text-[#0369A1]',
                    'Selesai'            => 'bg-[#EAF7EF] text-[#15803D]',
                    'Dibatalkan'         => 'bg-[#FEF2F2] text-[#B91C1C]',
                    default              => 'bg-[#F1F3F7] text-[#5B6472]',
                };
            @endphp
            <div class="flex items-center justify-between px-6 py-3 gap-4">
                <div>
                    <p class="font-semibold text-sm text-[#0B1220]">#{{ $pesanan->id }} · {{ $pesanan->produk->nama_produk }}</p>
                    <p class="text-[#8A93A6] text-xs mt-0.5">{{ $pesanan->user->nama_lengkap }}</p>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }} shrink-0">{{ $pesanan->status }}</span>
            </div>
        @empty
            <div class="text-center py-12 text-[#8A93A6] text-sm">Belum ada pesanan.</div>
        @endforelse
    </div>
</div>
@endsection