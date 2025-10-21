<x-app-layout>
    <x-slot name="pageHeading">
        {{ $book->title }}
    </x-slot>

    <x-slot name="pageDescription">
        Ajukan peminjaman dengan mengisi formulir di samping. Stok tersedia: {{ $book->quantity }} buku.
    </x-slot>

    <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr]">
        <div class="rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-[0_20px_50px_-25px_rgba(15,23,42,0.35)] space-y-6">
            <div class="relative overflow-hidden rounded-3xl">
                @if ($book->cover_image_path)
                    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="{{ $book->title }}" class="w-full rounded-3xl object-cover shadow-lg" />
                @else
                    <div class="flex h-80 w-full items-center justify-center rounded-3xl bg-slate-100 text-sm font-semibold text-slate-400">Belum ada gambar</div>
                @endif
                <div class="absolute top-4 left-4 inline-flex items-center gap-2 rounded-full border border-white/50 bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white">
                    {{ $book->category }}
                </div>
            </div>

            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                    <span class="material-symbols-rounded text-sm">person</span>
                    {{ $book->author ?? 'Penulis tidak diketahui' }}
                </div>
                <p class="text-sm leading-relaxed text-slate-600">{{ $book->description }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs text-slate-500">
                Tips: Waktu peminjaman maksimal 14 hari. Pastikan mengembalikan tepat waktu agar akunmu tetap aktif.
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200/80 bg-white/95 p-8 shadow-[0_20px_50px_-25px_rgba(15,23,42,0.35)]">
            <h3 class="text-lg font-semibold text-slate-800">Formulir Peminjaman</h3>
            <p class="mt-1 text-sm text-slate-500">Lengkapi data berikut untuk mengajukan peminjaman buku.</p>

            <form method="POST" action="{{ route('student.books.borrow', $book) }}" class="mt-6 space-y-5">
                @csrf

                @if ($book->quantity < 1)
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-600">
                        Stok buku sedang kosong. Silakan pilih buku lain atau hubungi admin perpustakaan.
                    </div>
                @endif

                <div>
                    <label for="borrower_name" class="text-sm font-semibold text-slate-700">Nama Peminjam</label>
                    <input type="text" id="borrower_name" name="borrower_name" value="{{ old('borrower_name', auth()->user()->name) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                    <x-input-error :messages="$errors->get('borrower_name')" class="mt-2" />
                </div>

                <div>
                    <label for="quantity" class="text-sm font-semibold text-slate-700">Jumlah Buku</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', min(1, $book->quantity)) }}" min="1" max="{{ max(1, $book->quantity) }}" @if($book->quantity < 1) disabled @endif required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 disabled:cursor-not-allowed disabled:bg-slate-100" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="borrowed_at" class="text-sm font-semibold text-slate-700">Tanggal Pinjam</label>
                        <input type="date" id="borrowed_at" name="borrowed_at" value="{{ old('borrowed_at', now()->toDateString()) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                        <x-input-error :messages="$errors->get('borrowed_at')" class="mt-2" />
                    </div>
                    <div>
                        <label for="return_date" class="text-sm font-semibold text-slate-700">Tanggal Kembali</label>
                        <input type="date" id="return_date" name="return_date" value="{{ old('return_date', now()->addDays(7)->toDateString()) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                        <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <label for="notes" class="text-sm font-semibold text-slate-700">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="3" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Contoh: diperlukan untuk tugas mata pelajaran ...">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500 disabled:cursor-not-allowed disabled:bg-slate-300" @if($book->quantity < 1) disabled @endif>
                    <span class="material-symbols-rounded text-base">bookmark_add</span>
                    Kirim Permintaan Peminjaman
                </button>

                <a href="{{ route('student.books.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Kembali ke Katalog
                </a>
            </form>
        </div>
    </div>
</x-app-layout>
