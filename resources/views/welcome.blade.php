<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pustaku | Sistem Peminjaman Buku Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen flex flex-col bg-white text-slate-900"
    style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <header class="absolute inset-x-0 top-0 z-30 py-6">
        <div class="mx-auto w-full max-w-7xl px-6">
            <div
                class="flex items-center justify-between gap-4 rounded-full border border-white/25 bg-white/20 px-6 py-3 text-white shadow-lg shadow-white/5 backdrop-blur-2xl">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <span
                        class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white/25 text-lg font-semibold text-white shadow-sm">P</span>
                    <div>
                        <p class="text-lg font-semibold">Pustaku</p>
                        <p class="text-xs uppercase tracking-[0.4em] text-white/70">Library</p>
                    </div>
                </a>
                <nav class="hidden items-center gap-3 text-sm text-white/80 md:flex">
                    <a href="#katalog"
                        class="rounded-full px-4 py-2 transition hover:bg-white/20 hover:text-white">Katalog</a>
                    <a href="#unggulan"
                        class="rounded-full px-4 py-2 transition hover:bg-white/20 hover:text-white">Unggulan</a>
                    <a href="#teknologi"
                        class="rounded-full px-4 py-2 transition hover:bg-white/20 hover:text-white">Teknologi</a>
                </nav>
                <div class="flex items-center gap-3 text-sm text-white">
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.books.index') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-white/35 bg-white/20 px-4 py-2 font-semibold text-white shadow-sm transition hover:border-white/45 hover:bg-white/25">
                            <span class="material-symbols-rounded text-base">space_dashboard</span>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-white/35 bg-white/20 px-4 py-2 font-semibold text-white shadow-sm transition hover:border-white/45 hover:bg-white/25">
                            <span class="material-symbols-rounded text-base">login</span>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-500/90 px-4 py-2 font-semibold text-white shadow-md transition hover:bg-indigo-400/90">
                            <span class="material-symbols-rounded text-base">person_add</span>
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(37,78,218,0.7),_rgba(15,23,42,0.95))]">
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-b from-slate-950/95 via-[#321B6D]/70 to-slate-950/95 backdrop-blur">
            </div>
            <div class="absolute -bottom-40 -left-32 h-80 w-80 rounded-full bg-purple-500/25 blur-3xl"></div>
            <div class="absolute -top-32 right-20 h-72 w-72 rounded-full bg-fuchsia-400/25 blur-3xl"></div>
            <div class="relative mx-auto w-full max-w-7xl px-6 pt-36 pb-16 text-white lg:pb-20 lg:pt-40">
                <div class="max-w-3xl">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/20 px-5 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white shadow-sm">
                        <span class="material-symbols-rounded text-sm">auto_stories</span>
                        Perpustakaan Digital Sekolah
                    </span>
                    <h1 class="mt-6 text-4xl font-semibold leading-tight md:text-5xl">
                        Jelajahi koleksi buku favoritmu dan ajukan peminjaman kapan saja.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-relaxed text-white/70">
                        Pustaku menggabungkan kemudahan Gramedia Digital dengan nuansa perpustakaan sekolah.
                        Cari buku, baca ringkasan, dan lanjutkan peminjaman setelah masuk ke akunmu.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-4" id="unggulan">
                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/30 bg-white/15 px-4 py-3 text-xs font-medium text-white/80 shadow-sm">
                            <span class="material-symbols-rounded text-indigo-200 text-base">check_circle</span>
                            Informasi buku lengkap beserta ketersediaan.
                        </div>
                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/30 bg-white/15 px-4 py-3 text-xs font-medium text-white/80 shadow-sm">
                            <span class="material-symbols-rounded text-indigo-200 text-base">favorite</span>
                            Desain ringan & familiar ala toko buku daring.
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('landing') }}"
                    class="mt-10 rounded-3xl border border-white/25 bg-white/90 p-6 shadow-xl shadow-indigo-900/20 backdrop-blur">
                    <div class="grid gap-4 md:grid-cols-[1.2fr_0.8fr_auto] md:items-end">
                        <div>
                            <label for="q"
                                class="text-xs font-semibold uppercase tracking-wide text-slate-500">Cari buku atau
                                penulis</label>
                            <div
                                class="mt-2 flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-2.5 shadow-sm focus-within:border-indigo-300 focus-within:ring-2 focus-within:ring-indigo-100">
                                <span class="material-symbols-rounded text-slate-400 text-base">search</span>
                                <input type="text" id="q" name="q" value="{{ $search }}"
                                    placeholder="Misal: Tere Liye, politik, desain"
                                    class="w-full border-0 bg-transparent text-sm text-slate-700 focus:outline-none" />
                            </div>
                        </div>

                        <div>
                            <label for="category"
                                class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</label>
                            <select id="category" name="category"
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                <option value="">Semua kategori</option>
                                @foreach ($categories as $categoryOption)
                                    <option value="{{ $categoryOption }}" @selected($categoryOption === $activeCategory)>
                                        {{ $categoryOption }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-indigo-500">
                            <span class="material-symbols-rounded text-base">filter_alt</span>
                            Terapkan
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <section id="katalog" class="mx-auto w-full max-w-7xl px-6 pb-16 mt-10">
            <h2 class="text-2xl font-semibold text-slate-800">Katalog Buku</h2>
            <p class="mt-1 text-sm text-slate-500">Menampilkan {{ $books->count() }} dari {{ $books->total() }}
                koleksi.</p>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($books as $book)
                    <article id="book-{{ $book->slug }}"
                        class="group flex h-full flex-col rounded-3xl border border-indigo-100 bg-white/90 shadow-[0_24px_60px_-36px_rgba(79,70,229,0.45)] transition hover:-translate-y-1 hover:border-indigo-200">
                        <a href="{{ route('landing.books.show', $book) }}"
                            class="relative block h-56 overflow-hidden rounded-t-3xl bg-slate-100">
                            @if ($book->cover_image_path)
                                <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{ $book->title }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105" />
                            @else
                                <div
                                    class="flex h-full w-full items-center justify-center text-xs font-semibold text-slate-400">
                                    Belum ada cover</div>
                            @endif
                            <div
                                class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-white/85 px-3 py-1 text-xs font-semibold text-indigo-600 shadow">
                                <span class="material-symbols-rounded text-sm">category</span>
                                {{ $book->category }}
                            </div>
                        </a>
                        <div class="flex flex-1 flex-col gap-4 p-6">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">{{ $book->title }}</h3>
                                <p class="mt-1 text-xs uppercase tracking-wide text-indigo-500">
                                    {{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                            </div>
                            <p class="text-sm leading-relaxed text-slate-500">
                                {{ \Illuminate\Support\Str::limit($book->description, 160) }}</p>
                            <div class="mt-auto flex items-center justify-between text-xs text-slate-400">
                                <span class="inline-flex items-center gap-2 font-medium text-slate-500">
                                    <span
                                        class="material-symbols-rounded text-base text-emerald-500">inventory_2</span>
                                    Stok: {{ $book->quantity }}
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 text-[11px] uppercase tracking-wide text-slate-400">
                                    <span class="material-symbols-rounded text-sm text-indigo-400">schedule</span>
                                    {{ optional($book->updated_at)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 pt-2">
                                <a href="{{ route('landing.books.show', $book) }}"
                                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-500 transition hover:border-indigo-200 hover:text-indigo-600">
                                    <span class="material-symbols-rounded text-base">info</span>
                                    Ringkasan
                                </a>
                                @auth
                                    @if (auth()->user()->isStudent())
                                        <a href="{{ route('student.books.show', $book) }}"
                                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">
                                            <span class="material-symbols-rounded text-base">library_books</span>
                                            Pinjam Buku
                                        </a>
                                    @else
                                        <a href="{{ route('admin.books.edit', $book) }}"
                                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-amber-500/90 px-4 py-2 text-sm font-semibold text-white transition hover:bg-amber-500">
                                            <span class="material-symbols-rounded text-base">edit</span>
                                            Kelola
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('student.books.show', $book) }}"
                                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">
                                        <span class="material-symbols-rounded text-base">login</span>
                                        Pinjam Buku
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </article>
                @empty
                    <div
                        class="col-span-full rounded-3xl border border-dashed border-indigo-100 bg-white/70 p-8 text-center text-sm text-slate-500">
                        Belum ada buku yang sesuai dengan pencarianmu.
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $books->links() }}
            </div>
        </section>


    </main>

    <footer class="mt-auto border-t border-indigo-100 bg-white/90 py-6 shadow-inner">
        <div
            class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-6 text-xs text-slate-500 md:flex-row">
            <p>&copy; {{ now()->year }} Pustaku. Proyek Web Programming XI RPL 2025/2026.</p>
            <p class="flex items-center gap-2 text-slate-400">
                <span class="material-symbols-rounded text-sm">code</span>
                Laravel 12 • TailwindCSS • Breeze
            </p>
        </div>
    </footer>
</body>

</html>
