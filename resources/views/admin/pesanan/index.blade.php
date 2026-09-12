@extends('layouts.admin')

@section('content')
<div class="flex items-start justify-between gap-4 mb-8">
    <div>
        <span class="text-sm font-medium text-[#5B6472]">Operasional</span>
        <h1 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220] mt-0.5">Pesanan masuk</h1>
    </div>
</div>

<div class="bg-white border border-[#E4E8F3] rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#F5F7FF] border-b border-[#E4E8F3]">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Pesanan</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Pembeli</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Total</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E4E8F3]">
                @forelse ($pesanans as $pesanan)
                    <tr class="hover:bg-[#F5F7FF] transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-sm text-[#0B1220]">#{{ $pesanan->id }}</p>
                            <p class="text-[#8A93A6] text-xs mt-0.5">{{ $pesanan->produk->nama_produk }} · {{ $pesanan->kuantitas }} item</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-sm text-[#0B1220]">{{ $pesanan->user->nama_lengkap }}</p>
                            <p class="text-[#8A93A6] text-xs mt-0.5">{{ $pesanan->alamat->kota }}</p>
                        </td>
                        <td class="px-5 py-4 text-sm font-semibold text-[#0B1220]">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4">
                            <form method="POST" action="{{ route('admin.pesanan.status', $pesanan) }}">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="border border-[#E4E8F3] rounded-lg px-2 py-1.5 text-xs text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition min-w-[160px]">
                                    @foreach (['Menunggu Pembayaran','Diproses','Dikirim','Selesai','Dibatalkan'] as $status)
                                        <option value="{{ $status }}" @selected($pesanan->status === $status)>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-16 text-[#8A93A6] text-sm">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-[#E4E8F3]">{{ $pesanans->links() }}</div>
</div>
@endsection