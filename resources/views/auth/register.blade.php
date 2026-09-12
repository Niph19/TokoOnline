<x-guest-layout>
    <h2 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220] mb-1">Buat akun</h2>
    <p class="text-[#5B6472] text-sm mb-6">Daftar dan mulai belanja di BliBlaBle</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="nama_lengkap" class="block text-sm font-medium text-[#0B1220] mb-1">Nama lengkap</label>
            <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autofocus
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('nama_lengkap') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="nickname" class="block text-sm font-medium text-[#0B1220] mb-1">Nickname</label>
            <input id="nickname" type="text" name="nickname" value="{{ old('nickname') }}" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('nickname') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-[#0B1220] mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('email') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-[#0B1220] mb-1">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('password') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-[#0B1220] mb-1">Konfirmasi password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('password_confirmation') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full py-2.5 bg-[#2451FF] text-white font-semibold rounded-lg hover:bg-[#17348F] transition-colors text-sm">
            Daftar
        </button>
    </form>

    <p class="text-center text-sm text-[#5B6472] mt-5">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-[#2451FF] font-semibold hover:underline">Masuk di sini</a>
    </p>
</x-guest-layout>