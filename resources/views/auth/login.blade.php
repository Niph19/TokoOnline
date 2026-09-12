<x-guest-layout>
    <h2 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220] mb-1">Selamat datang kembali</h2>
    <p class="text-[#5B6472] text-sm mb-6">Masuk ke akun BliBlaBle kamu</p>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 bg-[#F0FDF4] border border-[#BBF7D0] text-[#166534] rounded-lg text-sm">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-[#0B1220] mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('email') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-[#0B1220] mb-1">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full border border-[#E4E8F3] rounded-lg px-3 py-2.5 text-sm text-[#0B1220] focus:outline-none focus:border-[#2451FF] focus:ring-2 focus:ring-[#2451FF]/15 transition" />
            @error('password') <p class="text-[#DC2626] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2 cursor-pointer text-sm text-[#5B6472]">
            <input type="checkbox" name="remember" class="rounded border-[#E4E8F3] text-[#2451FF]" />
            Ingat saya
        </label>

        <button type="submit" class="w-full py-2.5 bg-[#2451FF] text-white font-semibold rounded-lg hover:bg-[#17348F] transition-colors text-sm">
            Masuk
        </button>
    </form>

    <p class="text-center text-sm text-[#5B6472] mt-5">
        Belum punya akun? <a href="{{ route('register') }}" class="text-[#2451FF] font-semibold hover:underline">Daftar sekarang</a>
    </p>
    @if (Route::has('password.request'))
        <p class="text-center text-sm text-[#8A93A6] mt-2">
            <a href="{{ route('password.request') }}" class="hover:text-[#2451FF] hover:underline">Lupa password?</a>
        </p>
    @endif
</x-guest-layout>