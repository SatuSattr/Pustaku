<x-app-layout>
    <x-slot name="pageHeading">
        Panel Admin
    </x-slot>

    <x-slot name="pageDescription">
        Ringkasan statistik koleksi buku dan aktivitas peminjaman terbaru.
    </x-slot>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-indigo-100 bg-white/80 p-6 shadow-[0_15px_35px_-20px_rgba(79,70,229,0.35)]">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-indigo-500">Total Buku</p>
            <p class="mt-4 text-3xl font-semibold text-slate-800">{{ $totalBooks }}</p>
            <p class="mt-2 text-xs text-slate-500">Jumlah seluruh koleksi di perpustakaan.</p>
        </div>

        <div class="rounded-3xl border border-emerald-100 bg-white/80 p-6 shadow-[0_15px_35px_-20px_rgba(16,185,129,0.35)]">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-500">Buku Tersedia</p>
            <p class="mt-4 text-3xl font-semibold text-slate-800">{{ $availableBooks }}</p>
            <p class="mt-2 text-xs text-slate-500">Siap dipinjam oleh siswa.</p>
        </div>

        <div class="rounded-3xl border border-amber-100 bg-white/80 p-6 shadow-[0_15px_35px_-20px_rgba(245,158,11,0.35)]">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-500">Proses</p>
            <p class="mt-4 text-3xl font-semibold text-slate-800">{{ $processingBorrowings }}</p>
            <p class="mt-2 text-xs text-slate-500">Menunggu konfirmasi admin.</p>
        </div>

        <div class="rounded-3xl border border-rose-100 bg-white/80 p-6 shadow-[0_15px_35px_-20px_rgba(244,63,94,0.35)]">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-rose-500">Sedang Dipinjam</p>
            <p class="mt-4 text-3xl font-semibold text-slate-800">{{ $activeBorrowings }}</p>
            <p class="mt-2 text-xs text-slate-500">Buku yang masih berada pada siswa.</p>
        </div>
    </div>

    <div class="grid gap-8 md:grid-cols-[1.6fr_1fr]">
        <div class="rounded-3xl border border-slate-200/70 bg-white/90 p-6 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)]">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Peminjaman Terbaru</h3>
                    <p class="text-xs text-slate-500">5 pengajuan dan peminjaman terakhir.</p>
                </div>
                <a href="{{ route('admin.borrowings.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">Lihat semua</a>
            </div>

            <div class="mt-6 space-y-4">
                @forelse ($recentBorrowings as $borrowing)
                    <div class="rounded-2xl border border-slate-200/60 p-4 transition hover:border-indigo-200">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-700">{{ $borrowing->book->title }}</p>
                                <p class="text-xs text-slate-500">Dipinjam oleh <span class="font-medium">{{ $borrowing->borrower_name }}</span></p>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium capitalize text-slate-600">
                                {{ $borrowing->statusLabel() }}
                            </span>
                        </div>
                        <div class="mt-3 grid gap-3 text-xs text-slate-500 md:grid-cols-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-rounded text-base text-indigo-400">calendar_today</span>
                                {{ $borrowing->borrowed_at->translatedFormat('d M Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-rounded text-base text-rose-400">event</span>
                                {{ $borrowing->return_date->translatedFormat('d M Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-rounded text-base text-emerald-400">library_books</span>
                                {{ $borrowing->quantity }} exemplar
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-rounded text-base text-slate-400">person</span>
                                {{ $borrowing->user->username }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                        Belum ada aktivitas peminjaman.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200/70 bg-white/90 p-6 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.25)]">
            <h3 class="text-lg font-semibold text-slate-800">Catatan Penting</h3>
            <ul class="mt-6 space-y-4 text-sm text-slate-600">
                <li class="flex gap-3">
                    <span class="material-symbols-rounded text-base text-indigo-500">task_alt</span>
                    Pastikan stok buku diperbarui setelah admin menandai status peminjaman menjadi <strong>Dikembalikan</strong>.
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-rounded text-base text-indigo-500">task_alt</span>
                    Manfaatkan halaman <strong>Kelola Buku</strong> untuk menambahkan detail deskripsi dan gambar menarik pada buku.
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-rounded text-base text-indigo-500">task_alt</span>
                    Gunakan filter pada list peminjaman untuk memantau proses, buku yang sudah dipinjam, dan pengembalian.
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>
