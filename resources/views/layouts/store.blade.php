<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Toko Kita' }} | Toko Kita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="store-shell">
    <header class="site-header">
        <div class="container site-header__inner">
            <a href="{{ route('landing') }}" class="brand">TOKO KITA <span>online store</span></a>
            <nav class="site-nav" aria-label="Navigasi utama">
                <a href="{{ route('landing') }}">Produk</a>
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
                    @else
                        <a href="{{ route('pesanan.index') }}">Pesanan Saya</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="link-button">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Masuk</a>
                    <a class="button button--small" href="{{ route('register') }}">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>
    @if (session('success'))
        <div class="container flash flash--success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="container flash flash--error">{{ session('error') }}</div>
    @endif
    <main>@yield('content')</main>
    <footer class="site-footer"><div class="container">Toko Kita &middot; Belanja sederhana, pesanan terpantau.</div></footer>
</body>
</html>
