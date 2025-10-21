<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Masuk | Pustaku' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen overflow-hidden bg-slate-950 text-white"
    style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(37,78,218,0.65),_rgba(2,6,23,0.95))]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-[#321B6D]/55 to-slate-950"></div>
        <div class="absolute -top-28 -left-10 h-72 w-72 rounded-full bg-indigo-500/35 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-[28rem] w-[28rem] rounded-full bg-purple-500/35 blur-3xl"></div>
    </div>

    <div class="relative z-10 flex min-h-screen items-center justify-center px-6 py-16">
        <div class="mx-auto grid w-full max-w-7xl gap-12 md:grid-cols-[1.1fr_0.9fr]">
            <div class="hidden md:flex flex-col justify-between">
                <div>
                    <div
                        class="inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-5 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white/80">
                        <span class="material-symbols-rounded text-sm">auto_stories</span>
                        Pustaku Digital
                    </div>
                    <h1 class="mt-8 text-4xl font-semibold leading-snug">
                        Kelola peminjaman <span class="text-indigo-200">lebih cepat</span> untuk perpustakaan sekolah.
                    </h1>
                    <p class="mt-4 text-sm text-white/70">
                        Masuk sebagai admin untuk mengatur inventaris buku, atau sebagai siswa untuk mencari dan
                        meminjam koleksi favoritmu. Semua dalam satu sistem terpadu.
                    </p>
                </div>

                <div class="mt-16 grid gap-6 text-sm text-white/80">
                    <div class="flex items-center gap-3">
                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/10 text-lg">1</span>
                        <div>
                            <p class="font-semibold">Masuk dengan username</p>
                            <p class="text-xs text-white/60">Gunakan akun admin atau siswa yang sudah terdaftar.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/10 text-lg">2</span>
                        <div>
                            <p class="font-semibold">Kelola koleksi</p>
                            <p class="text-xs text-white/60">Admin dapat menambah, mengubah, dan menghapus data buku
                                lengkap dengan stok.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/10 text-lg">3</span>
                        <div>
                            <p class="font-semibold">Ajukan peminjaman</p>
                            <p class="text-xs text-white/60">Siswa dapat melihat ketersediaan buku real-time dan mengisi
                                formulir peminjaman.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="rounded-[28px] bg-white/95 p-8 shadow-[0_20px_80px_-15px_rgba(15,23,42,0.45)] ring-1 ring-slate-200/80 backdrop-blur">
                <div class="mb-6 flex items-center gap-3">
                    <span
                        class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-500">
                        <span class="material-symbols-rounded text-2xl">account_circle</span>
                    </span>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Selamat datang</p>
                        <h2 class="text-xl font-semibold text-slate-800">Masuk ke Pustaku</h2>
                    </div>
                </div>

                <div class="space-y-1 text-sm text-slate-500 mb-6">
                    <p>Gunakan akun mu untuk mengakses sistem perpustakaan.</p>

                </div>

                <div class="space-y-6">
                    {{ $slot }}
                </div>

                <p class="mt-10 text-center text-xs text-slate-400">
                    &copy; {{ now()->year }} Pustaku • Sistem Peminjaman Buku berbasis Digital
                </p>
            </div>
        </div>
    </div>
</body>

</html>
