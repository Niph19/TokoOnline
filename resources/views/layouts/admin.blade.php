<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel Admin' }} | Toko Kita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell">
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand brand--light">TOKO KITA <span>admin panel</span></a>
        <nav class="admin-nav" aria-label="Navigasi admin">
            <a href="{{ route('admin.dashboard') }}">Ringkasan</a>
            <a href="{{ route('admin.produk.index') }}">Kelola Produk</a>
            <a href="{{ route('admin.pesanan.index') }}">Pesanan Masuk</a>
            <a href="{{ route('landing') }}">Lihat Toko</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="admin-logout">@csrf<button type="submit" class="link-button link-button--light">Keluar</button></form>
    </aside>
    <main class="admin-main">
        <div class="admin-topbar"><span>Panel Admin</span><strong>{{ Auth::user()->nama_lengkap }}</strong></div>
        @if (session('success')) <div class="flash flash--success">{{ session('success') }}</div> @endif
        @yield('content')
    </main>
</body>
</html>
