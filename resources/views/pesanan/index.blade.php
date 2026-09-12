@extends('layouts.store')

@section('content')
<div class="max-w-6xl mx-auto px-5 py-12">
    <h1 class="font-['Space_Grotesk'] text-3xl font-semibold text-[#0B1220] mb-8">Pesanan saya</h1>

    @if ($pesanans->isEmpty())
        <div class="text-center py-20 border-2 border-dashed border-[#E4E8F3] rounded-2xl text-[#8A93A6]">
            Belum ada pesanan. <a href="{{ route('landing') }}" class="text-[#2451FF] hover:underline font-medium">Lihat katalog</a>
        </div>
    @else
        <div class="flex flex-col gap-3">
            @foreach ($pesanans as $pesanan)
                <a href="{{ route('pesanan.show', $pesanan->id) }}"
                   class="flex items-center justify-between gap-4 px-5 py-4 bg-white border border-[#E4E8F3] rounded-2xl hover:shadow-sm hover:border-[#2451FF]/30 transition-all no-underline text-[#0B1220]">
                    <div>
                        <p class="font-semibold text-sm text-[#0B1220]">#{{ $pesanan->id }} · {{ $pesanan->produk->nama_produk }}</p>
                        <p class="text-[#8A93A6] text-xs mt-0.5">{{ $pesanan->created_at->format('d M Y') }} · {{ $pesanan->kuantitas }} item</p>
                    </div>
                    <div class="text-right shrink-0">
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
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }} mb-1">{{ $pesanan->status }}</span>
                        <p class="font-semibold text-sm text-[#0B1220]">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6">{{ $pesanans->links() }}</div>
    @endif
</div>
@endsection