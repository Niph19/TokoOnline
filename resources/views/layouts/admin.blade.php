<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel Admin' }} | BliBlaBle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex bg-slate-50 antialiased">

    {{-- Sidebar --}}
    <aside class="w-64 shrink-0 bg-blue-950 text-white flex flex-col px-4 py-6 sticky top-0 h-screen overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 mb-8 no-underline">
            <span class="w-8 h-8 bg-blue-400/30 border border-white/20 rounded-lg flex items-center justify-center font-black text-xs">BB</span>
            <span class="font-extrabold tracking-tight text-white">BliBlaBle <span class="text-white/50 text-xs font-medium">admin</span></span>
        </a>

        <nav class="flex flex-col gap-1 flex-1">
            <span class="text-white/35 text-xs font-bold uppercase tracking-widest px-3 py-2">Menu</span>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-white/70 text-sm font-medium hover:bg-white/10 hover:text-white transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-400/20 text-blue-200' : '' }}">
                Ringkasan
            </a>
            <a href="{{ route('admin.produk.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-white/70 text-sm font-medium hover:bg-white/10 hover:text-white transition-colors {{ request()->routeIs('admin.produk.*') ? 'bg-blue-400/20 text-blue-200' : '' }}">
                Kelola Produk
            </a>
            <a href="{{ route('admin.pesanan.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-white/70 text-sm font-medium hover:bg-white/10 hover:text-white transition-colors {{ request()->routeIs('admin.pesanan.*') ? 'bg-blue-400/20 text-blue-200' : '' }}">
                Pesanan Masuk
            </a>
            <a href="{{ route('landing') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-white/70 text-sm font-medium hover:bg-white/10 hover:text-white transition-colors">
                Lihat Toko
            </a>
        </nav>

        <div class="pt-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-white/50 text-sm font-medium hover:bg-white/10 hover:text-white transition-colors bg-transparent border-0 cursor-pointer">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 flex flex-col min-w-0">
        {{-- Topbar --}}
        <div class="bg-white border-b border-slate-200 px-8 h-14 flex items-center justify-between gap-4 sticky top-0 z-40">
            <span class="text-sm font-semibold text-slate-700">Panel Admin</span>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <span class="w-7 h-7 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">{{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}</span>
                {{ Auth::user()->nama_lengkap }}
            </div>
        </div>

        {{-- Flash --}}
        @if (session('success'))
            <div class="mx-8 mt-4 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm font-medium">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mx-8 mt-4 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm font-medium">{{ session('error') }}</div>
        @endif

        <div class="p-8 flex-1">
            @yield('content')
        </div>
    </div>

</body>
</html>
