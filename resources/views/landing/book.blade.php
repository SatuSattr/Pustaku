<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} | Pustaku</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen flex flex-col bg-slate-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <header class="absolute inset-x-0 top-0 z-30 py-6">
        <div class="mx-auto w-full max-w-7xl px-6">
            <div
                class="flex items-center justify-between gap-4 rounded-full border border-indigo-100 bg-white px-6 py-3 text-slate-900 shadow-xl shadow-indigo-100/60 backdrop-blur">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <span
                        class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-lg font-semibold text-indigo-600 shadow-sm">P</span>
                    <div>
                        <p class="text-lg font-semibold text-slate-900">Pustaku</p>
                        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Library</p>
                    </div>
                </a>
                <nav class="hidden items-center gap-3 text-sm text-slate-600 md:flex">
                    <a href="{{ route('landing') }}"
                        class="rounded-full px-4 py-2 transition hover:bg-indigo-50 hover:text-indigo-600">Katalog</a>
                    <a href="#unggulan"
                        class="rounded-full px-4 py-2 transition hover:bg-indigo-50 hover:text-indigo-600">Unggulan</a>
                    <a href="#teknologi"
                        class="rounded-full px-4 py-2 transition hover:bg-indigo-50 hover:text-indigo-600">Teknologi</a>
                </nav>
                <div class="flex items-center gap-3 text-sm text-slate-700">
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.books.index') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-4 py-2 font-semibold text-indigo-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-700">
                            <span class="material-symbols-rounded text-base">space_dashboard</span>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-4 py-2 font-semibold text-indigo-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-700">
                            <span class="material-symbols-rounded text-base">login</span>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 font-semibold text-white shadow-md transition hover:bg-indigo-500">
                            <span class="material-symbols-rounded text-base">person_add</span>
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 pt-28 mt-10">
        <section class="mx-auto w-full max-w-7xl px-6 pb-12">
            <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="rounded-3xl border border-indigo-100 bg-white p-6 shadow-lg shadow-indigo-100/60">
                    <div class="aspect-[3/4] overflow-hidden rounded-2xl bg-slate-100">
                        @if ($book->cover_image_path)
                            <img src="{{ asset('storage/' . $book->cover_image_path) }}"
                                alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                        @else
                            <div
                                class="flex h-full w-full items-center justify-center text-sm font-semibold text-slate-400">
                                Belum ada cover</div>
                        @endif
                    </div>
                    <div class="mt-5 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500">
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 font-semibold text-emerald-600">
                            <span class="material-symbols-rounded text-sm">inventory_2</span>
                            Stok: {{ $book->quantity }}
                        </span>
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1 font-semibold text-indigo-600">
                            <span class="material-symbols-rounded text-sm">category</span>
                            {{ $book->category }}
                        </span>
                    </div>
                </div>

                <article class="space-y-6">
                    <header>
                        <h1 class="text-3xl font-semibold text-slate-900">{{ $book->title }}</h1>
                        <p class="mt-2 text-sm uppercase tracking-wide text-indigo-500">
                            {{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                    </header>

                    <div
                        class="rounded-3xl border border-slate-200 bg-white/90 p-6 text-sm leading-relaxed text-slate-600 shadow-sm">
                        {{ $book->description }}
                    </div>

                    <div
                        class="rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-white p-6 shadow-inner">
                        <h2 class="text-base font-semibold text-slate-800">Ingin meminjam buku ini?</h2>
                        <p class="mt-2 text-xs text-slate-500">
                            {{ $book->quantity > 0 ? 'Klik tombol di bawah, masuk ke akunmu, dan isi formulir peminjaman.' : 'Saat ini stok habis. Kamu bisa memantau lagi nanti atau hubungi admin perpustakaan.' }}
                        </p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            @auth
                                @if (auth()->user()->isStudent())
                                    <a href="{{ route('student.books.show', $book) }}"
                                        class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">
                                        <span class="material-symbols-rounded text-base">library_books</span>
                                        Ajukan Peminjaman
                                    </a>
                                @elseif(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.books.edit', $book) }}"
                                        class="inline-flex items-center gap-2 rounded-full bg-amber-500/90 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-500">
                                        <span class="material-symbols-rounded text-base">edit</span>
                                        Kelola Buku
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('student.books.show', $book) }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">
                                    <span class="material-symbols-rounded text-base">login</span>
                                    Masuk untuk Meminjam
                                </a>
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-5 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-700">
                                    <span class="material-symbols-rounded text-base">person_add</span>
                                    Daftar Akun
                                </a>
                            @endauth
                        </div>
                    </div>

                    <dl class="grid gap-4 text-xs text-slate-500 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3">
                            <dt class="font-semibold text-slate-700">Terakhir diperbarui</dt>
                            <dd class="mt-1">{{ optional($book->updated_at)->translatedFormat('d M Y H:i') }}</dd>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3">
                            <dt class="font-semibold text-slate-700">Ditambahkan pada</dt>
                            <dd class="mt-1">{{ optional($book->created_at)->translatedFormat('d M Y H:i') }}</dd>
                        </div>
                    </dl>

                    <a href="{{ route('landing') }}"
                        class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-600 transition hover:text-indigo-500">
                        <span class="material-symbols-rounded text-base">arrow_back</span>
                        Kembali ke katalog
                    </a>
                </article>
            </div>
        </section>
    </main>

    <footer class="mt-auto border-t border-indigo-100 bg-white/90 py-6">
        <div
            class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-6 text-xs text-slate-500 md:flex-row">
            <p>&copy; {{ now()->year }} Pustaku.</p>
            <p class="flex items-center gap-2 text-slate-400">
                <span class="material-symbols-rounded text-sm">code</span>
                Laravel 12 • TailwindCSS • Breeze
            </p>
        </div>
    </footer>
</body>

</html>
