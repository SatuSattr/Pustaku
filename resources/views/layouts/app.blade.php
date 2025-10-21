<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Pustaku') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-100 text-slate-900" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    @php
        $user = auth()->user();
        $isAdmin = $user?->isAdmin();
        $navItems = $isAdmin
            ? [
                ['label' => 'Dasbor', 'route' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'space_dashboard'],
                ['label' => 'Kelola Buku', 'route' => route('admin.books.index'), 'active' => request()->routeIs('admin.books.*'), 'icon' => 'menu_book'],
                ['label' => 'Peminjaman', 'route' => route('admin.borrowings.index'), 'active' => request()->routeIs('admin.borrowings.*'), 'icon' => 'swap_calls'],
            ]
            : [
                ['label' => 'Katalog Buku', 'route' => route('student.books.index'), 'active' => request()->routeIs('student.books.*'), 'icon' => 'collections_bookmark'],
                ['label' => 'Riwayat Peminjaman', 'route' => route('student.borrowings.index'), 'active' => request()->routeIs('student.borrowings.*'), 'icon' => 'history'],
                ['label' => 'Profil', 'route' => route('profile.edit'), 'active' => request()->routeIs('profile.*'), 'icon' => 'manage_accounts'],
            ];
        $pageHeading = $pageHeading ?? ($header ?? null);
        $pageDescription = $pageDescription ?? ($isAdmin ? 'Kelola koleksi dan peminjaman perpustakaan.' : 'Temukan buku favoritmu dan ajukan peminjaman.');
    @endphp

    <div class="min-h-screen flex flex-col md:flex-row">
        <aside class="relative text-white md:w-72 w-full shadow-xl md:sticky md:top-0 md:h-screen md:flex-shrink-0 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(37,78,218,0.7),_rgba(15,23,42,0.95))]"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-[#321B6D]/65 to-slate-950/95"></div>
            <div class="absolute -bottom-24 -left-16 h-56 w-56 rounded-full bg-purple-500/25 blur-3xl"></div>
            <div class="absolute top-16 -right-24 h-48 w-48 rounded-full bg-fuchsia-400/20 blur-3xl"></div>
            <div class="relative px-6 py-8 border-b border-white/15">
                <a href="{{ $isAdmin ? route('admin.dashboard') : route('student.books.index') }}" class="flex items-center gap-3">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 text-2xl font-semibold">P</span>
                    <div>
                        <p class="text-lg font-semibold tracking-tight">Pustaku</p>
                        <p class="text-xs uppercase tracking-[0.25em] text-white/60">Library</p>
                    </div>
                </a>
                <p class="mt-6 text-sm text-white/80 leading-relaxed">
                    {{ $isAdmin ? 'Panel admin untuk memantau stok dan peminjaman buku.' : 'Perpustakaan digital sekolah yang mudah diakses kapan saja.' }}
                </p>
            </div>

            <nav class="relative px-3 py-6 space-y-1 hidden md:block">
                @foreach ($navItems as $item)
                    <a href="{{ $item['route'] }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all @if($item['active']) bg-gradient-to-r from-indigo-500/70 via-purple-500/70 to-indigo-500/70 text-white shadow-lg shadow-purple-900/30 @else text-white/75 hover:bg-white/10 hover:text-white @endif">
                        <span class="material-symbols-rounded text-xl">{{ $item['icon'] }}</span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="relative md:hidden px-4 py-4 border-t border-white/15">
                <div class="flex gap-2 overflow-x-auto">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['route'] }}" class="flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-medium uppercase tracking-wide transition @if($item['active']) border-white bg-white text-indigo-600 @else border-white/40 text-white/80 @endif">
                            <span class="material-symbols-rounded text-sm">{{ $item['icon'] }}</span>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="relative px-6 py-6 border-t border-white/15 hidden md:flex flex-col gap-3">
                <div class="rounded-2xl bg-white/10 p-4">
                    <p class="text-xs uppercase tracking-wide text-white/60">Masuk sebagai</p>
                    <p class="mt-1 text-sm font-semibold">{{ $user?->name }}</p>
                    <p class="text-xs text-white/60 capitalize">{{ $user?->role }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-white/15 px-4 py-3 text-sm font-semibold text-white transition hover:bg-white/20">
                        <span class="material-symbols-rounded text-base">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-slate-200/70">
                <div class="px-6 py-5 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        @if ($pageHeading)
                            <div class="text-2xl font-semibold text-slate-800">
                                {!! $pageHeading !!}
                            </div>
                        @endif
                        @if ($pageDescription)
                            <p class="mt-1 text-sm text-slate-500">{{ $pageDescription }}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-4 md:gap-6">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-semibold text-slate-700">{{ $user?->name }}</p>
                            <p class="text-xs text-slate-400 capitalize">{{ $user?->role }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="hidden md:inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-medium text-slate-600 transition hover:border-indigo-200 hover:text-indigo-600">
                            <span class="material-symbols-rounded text-base">account_circle</span>
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 transition hover:border-rose-200 hover:text-rose-500">
                                <span class="material-symbols-rounded text-base">logout</span>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 py-8">
                <div class="mx-auto max-w-7xl space-y-8">
                    @if (session('status'))
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

            <footer class="px-6 py-4 bg-white/80 backdrop-blur border-t border-slate-200/70 text-xs text-slate-500 text-center">
                &copy; {{ now()->year }} Pustaku. Dibuat untuk memenuhi Product Requirements Document kelas XI RPL.
            </footer>
        </div>
    </div>
</body>
</html>
