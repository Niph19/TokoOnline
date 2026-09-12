@extends('layouts.store')

@section('content')
<div class="max-w-3xl mx-auto px-5 py-12">
    <a href="{{ route('pesanan.index') }}" class="inline-flex items-center gap-1 text-[#8A93A6] text-sm hover:text-[#2451FF] transition-colors mb-6">
        &larr; Kembali ke pesanan
    </a>

    <span class="text-sm font-medium text-[#5B6472]">Detail pesanan #{{ $pesanan->id }}</span>
    <h1 class="font-['Space_Grotesk'] text-3xl font-semibold text-[#0B1220] mt-1 mb-6">{{ $pesanan->produk->nama_produk }}</h1>

    <div class="bg-white border border-[#E4E8F3] rounded-2xl p-6">
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
        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }} mb-6">{{ $pesanan->status }}</span>

        <dl class="divide-y divide-[#E4E8F3]">
            <div class="flex justify-between items-center py-3">
                <dt class="text-[#5B6472] text-sm">Jumlah</dt>
                <dd class="font-semibold text-sm text-[#0B1220]">{{ $pesanan->kuantitas }} item</dd>
            </div>
            <div class="flex justify-between items-center py-3">
                <dt class="text-[#5B6472] text-sm">Total</dt>
                <dd class="font-semibold text-[#2451FF]">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</dd>
            </div>
            <div class="flex justify-between items-center py-3">
                <dt class="text-[#5B6472] text-sm">Pembayaran</dt>
                <dd class="font-semibold text-sm text-[#0B1220]">{{ strtoupper($pesanan->tipe) }}</dd>
            </div>
            <div class="flex justify-between items-center py-3">
                <dt class="text-[#5B6472] text-sm">Alamat</dt>
                <dd class="font-semibold text-sm text-[#0B1220] text-right">{{ $pesanan->alamat->alamat }}, {{ $pesanan->alamat->kota }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection