<div class="bg-white border border-[#E4E8F3] rounded-2xl p-6 max-w-2xl">
    <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @if ($formMethod !== 'POST') @method($formMethod) @endif

        <div>
            <label for="nama_produk" class="block text-sm font-medium text-[#0B1220] mb-1">Nama produk</label>
            <input id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk?->nama_produk) }}" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('nama_produk') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="harga" class="block text-sm font-medium text-[#0B1220] mb-1">Harga</label>
                <input id="harga" type="number" name="harga" min="0" value="{{ old('harga', $produk?->harga) }}" required
                    class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                @error('harga') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="stok" class="block text-sm font-medium text-[#0B1220] mb-1">Stok</label>
                <input id="stok" type="number" name="stok" min="0" value="{{ old('stok', $produk?->stok) }}" required
                    class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
                @error('stok') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-[#0B1220] mb-1">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition resize-vertical">{{ old('deskripsi', $produk?->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-[#0B1220] mb-1">Gambar produk</label>
            <input id="image" type="file" name="image" accept="image/*" {{ $produk ? '' : 'required' }}
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2 text-sm text-[#5B6472] bg-[#F5F7FF] cursor-pointer" />
            @error('image') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="px-6 py-2.5 bg-[#2451FF] text-white text-sm font-semibold rounded-lg hover:bg-[#17348F] transition-colors">
            Simpan produk
        </button>
    </form>
</div>