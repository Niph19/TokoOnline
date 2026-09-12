@extends('layouts.admin')

@section('content')
<div class="flex items-start justify-between gap-4 mb-8">
    <div>
        <span class="text-sm font-medium text-[#5B6472]">Inventaris</span>
        <h1 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220] mt-0.5">Kelola produk</h1>
    </div>
    <a href="{{ route('admin.produk.create') }}" class="px-4 py-2 bg-[#2451FF] text-white text-sm font-semibold rounded-lg hover:bg-[#17348F] transition-colors shrink-0">
        Tambah Produk
    </a>
</div>

<div class="bg-white border border-[#E4E8F3] rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#F5F7FF] border-b border-[#E4E8F3]">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Produk</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Stok</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-[#5B6472]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E4E8F3]">
                @forelse ($produks as $produk)
                    <tr class="hover:bg-[#F5F7FF] transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-sm text-[#0B1220]">{{ $produk->nama_produk }}</p>
                            <p class="text-[#8A93A6] text-xs mt-0.5 max-w-xs truncate">{{ $produk->deskripsi }}</p>
                        </td>
                        <td class="px-5 py-4 text-sm text-[#0B1220] font-medium">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-4 text-sm text-[#0B1220]">{{ $produk->stok }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.produk.edit', $produk) }}" class="text-sm text-[#2451FF] font-medium hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.produk.destroy', $produk) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus produk ini?')"
                                        class="text-sm text-[#DC2626] font-medium hover:underline bg-transparent border-0 cursor-pointer p-0">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-16 text-[#8A93A6] text-sm">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-[#E4E8F3]">{{ $produks->links() }}</div>
</div>
@endsection