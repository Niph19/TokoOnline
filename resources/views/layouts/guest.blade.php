<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BliBlaBle') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen grid md:grid-cols-2">

        {{-- Left: brand panel --}}
        <div class="hidden md:flex flex-col justify-center bg-[#0A1435] text-white px-12 py-16 relative overflow-hidden">
            <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full bg-[#2451FF]/15"></div>
            <div class="absolute -bottom-24 -left-16 w-72 h-72 rounded-full bg-[#2451FF]/10"></div>

            <div class="relative z-10">
                <a href="/" class="flex items-center gap-2 mb-10 no-underline">
                    <span class="w-11 h-11 bg-[#2451FF] rounded-xl flex items-center justify-center font-bold text-lg">BB</span>
                    <span class="font-['Space_Grotesk'] text-2xl font-semibold tracking-tight">BliBlaBle</span>
                </a>
                <h1 class="font-['Space_Grotesk'] text-4xl font-semibold leading-tight mb-3">Satu toko,<br>semua kamu perlu.</h1>
                <p class="text-white/65 text-base leading-relaxed mb-10 max-w-sm">Pilih produk, checkout dalam hitungan detik, dan pantau pesananmu sampai tiba di depan pintu.</p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-white/80 text-sm"><span class="w-1.5 h-1.5 rounded-full bg-[#2451FF] shrink-0"></span>Checkout cepat, tanpa akun ribet</li>
                    <li class="flex items-center gap-3 text-white/80 text-sm"><span class="w-1.5 h-1.5 rounded-full bg-[#2451FF] shrink-0"></span>Status pesanan real-time</li>
                    <li class="flex items-center gap-3 text-white/80 text-sm"><span class="w-1.5 h-1.5 rounded-full bg-[#2451FF] shrink-0"></span>COD atau transfer, kamu yang pilih</li>
                </ul>
            </div>
        </div>

        {{-- Right: form panel --}}
        <div class="flex items-center justify-center px-6 py-12 bg-white">
            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>