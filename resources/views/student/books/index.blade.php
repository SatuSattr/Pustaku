<x-app-layout>
    <x-slot name="pageHeading">
        Jelajahi Koleksi Buku
    </x-slot>

    <x-slot name="pageDescription">
        Temukan buku favoritmu dan ajukan peminjaman secara daring.
    </x-slot>

    <form method="GET" class="grid gap-4 rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)] md:grid-cols-[1fr_auto] md:items-end">
        <div>
            <label for="q" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Cari Judul / Penulis</label>
            <div class="mt-2 flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-2.5 shadow-sm focus-within:border-indigo-300 focus-within:ring-2 focus-within:ring-indigo-200">
                <span class="material-symbols-rounded text-slate-400">search</span>
                <input id="q" type="text" name="q" value="{{ $search }}" placeholder="Masukkan kata kunci" class="w-full border-0 bg-transparent text-sm text-slate-700 focus:ring-0" />
            </div>
        </div>
        <div class="grid gap-3 md:grid-cols-2 md:items-center">
            <div>
                <label for="category" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</label>
                <select id="category" name="category" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item }}" @selected($item === $category)>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">
                <span class="material-symbols-rounded text-base">filter_alt</span>
                Terapkan Filter
            </button>
        </div>
    </form>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($books as $book)
            <article class="group rounded-3xl border border-slate-200/80 bg-white/95 shadow-[0_20px_50px_-25px_rgba(15,23,42,0.35)] transition hover:-translate-y-1">
                <div class="relative h-56 overflow-hidden rounded-t-3xl">
                    @if ($book->cover_image_path)
                        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="{{ $book->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-slate-100 text-sm font-semibold text-slate-400">
                            Belum ada gambar
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    <div class="absolute left-4 bottom-4 text-white">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide">{{ $book->category }}</span>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">{{ $book->title }}</h3>
                        <p class="text-xs text-slate-500">{{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-600">{{ \Illuminate\Support\Str::limit($book->description, 140) }}</p>
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-600">Stok: {{ $book->quantity }}</span>
                        <a href="{{ route('student.books.show', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-indigo-200 px-3 py-1 font-semibold text-indigo-600 transition hover:bg-indigo-50">
                            <span class="material-symbols-rounded text-base">open_in_new</span>
                            Ajukan Pinjam
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-3xl border border-dashed border-slate-200 bg-white/70 p-8 text-center text-sm text-slate-500">
                Tidak ada buku yang sesuai dengan pencarianmu.
            </div>
        @endforelse
    </div>

    <div>
        {{ $books->links() }}
    </div>
</x-app-layout>
