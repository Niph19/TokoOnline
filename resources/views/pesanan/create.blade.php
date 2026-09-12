@extends('layouts.store')

@section('content')
<div class="max-w-6xl mx-auto px-5 py-12">
    <h1 class="font-['Space_Grotesk'] text-3xl font-semibold text-[#0B1220] mb-8">Lengkapi pesanan</h1>

    <div class="grid md:grid-cols-[1.2fr_.8fr] gap-6 items-start">

        {{-- Form --}}
        <div class="bg-white border border-[#E4E8F3] rounded-2xl p-6">
            <form method="POST" action="{{ route('pesanan.store', $produk) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Alamat --}}
                <div>
                    <label for="alamat_id" class="block text-sm font-medium text-[#0B1220] mb-1">Alamat pengiriman</label>
                    @if ($alamats->isNotEmpty())
                        <select id="alamat_id" name="alamat_id" required
                            class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition">
                            <option value="">Pilih alamat</option>
                            @foreach ($alamats as $alamat)
                                <option value="{{ $alamat->id }}">{{ $alamat->alamat }}, {{ $alamat->kota }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="text-[#8A93A6] text-sm mb-3">Simpan alamat pengiriman untuk pesanan ini.</p>
                        <input name="alamat" placeholder="Alamat lengkap" required
                            class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition mb-3" />
                        <div class="grid grid-cols-2 gap-3">
                            <input name="kecamatan" placeholder="Kecamatan" required class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                            <input name="kota" placeholder="Kota" required class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                            <input name="provinsi" placeholder="Provinsi" required class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                            <input name="kode_pos" placeholder="Kode pos" required class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                        </div>
                    @endif
                </div>

                {{-- Kuantitas --}}
                <div>
                    <label for="kuantitas" class="block text-sm font-medium text-[#0B1220] mb-1">Kuantitas</label>
                    <input id="kuantitas" type="number" name="kuantitas" min="1" max="{{ $produk->stok }}" value="1" required
                        class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                </div>

                {{-- Metode pembayaran --}}
                <div>
                    <p class="text-sm font-medium text-[#0B1220] mb-2">Metode pembayaran</p>
                    <div class="flex gap-3">
                        <label class="flex items-center gap-2 px-4 py-2.5 border border-[#E4E8F3] rounded-lg cursor-pointer text-sm font-medium text-[#5B6472] has-[:checked]:border-[#2451FF] has-[:checked]:bg-[#F5F7FF] has-[:checked]:text-[#2451FF] transition">
                            <input type="radio" name="tipe" value="cod" checked class="accent-[#2451FF]" /> COD
                        </label>
                        <label class="flex items-center gap-2 px-4 py-2.5 border border-[#E4E8F3] rounded-lg cursor-pointer text-sm font-medium text-[#5B6472] has-[:checked]:border-[#2451FF] has-[:checked]:bg-[#F5F7FF] has-[:checked]:text-[#2451FF] transition">
                            <input type="radio" name="tipe" value="transfer" class="accent-[#2451FF]" /> Transfer
                        </label>
                    </div>
                </div>

                {{-- Bukti pembayaran --}}
                <div>
                    <label for="bukti_pembayaran" class="block text-sm font-medium text-[#0B1220] mb-1">
                        Bukti pembayaran <span class="font-normal text-[#8A93A6]">(wajib untuk transfer)</span>
                    </label>
                    <input id="bukti_pembayaran" type="file" name="bukti_pembayaran" accept="image/*"
                        class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2 text-sm text-[#5B6472] bg-[#F5F7FF] cursor-pointer" />
                </div>

                @if ($errors->any())
                    <div class="px-4 py-3 bg-[#FEF2F2] border border-[#FECACA] rounded-lg text-[#991B1B] text-sm">
                        @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                    </div>
                @endif

                <button type="submit" class="w-full py-3 bg-[#2451FF] text-white font-semibold rounded-lg hover:bg-[#17348F] transition-colors">
                    Buat pesanan
                </button>
            </form>
        </div>

        {{-- Summary --}}
        <aside class="bg-white border border-[#E4E8F3] rounded-2xl p-6">
            <span class="text-sm font-medium text-[#5B6472]">Ringkasan</span>
            <div class="aspect-video bg-[#F5F7FF] rounded-xl mt-3 mb-4 flex items-center justify-center overflow-hidden">
                @if ($produk->image)
                    <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                @else
                    <span class="text-[#8FA3FF] text-sm">Foto produk</span>
                @endif
            </div>
            <h2 class="font-semibold text-[#0B1220] text-lg mb-1">{{ $produk->nama_produk }}</h2>
            <p class="text-[#5B6472] text-sm leading-relaxed mb-4">{{ $produk->deskripsi }}</p>
            <span class="text-2xl font-semibold text-[#2451FF]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
        </aside>

    </div>
</div>
@endsection