<x-app-layout>
    <x-slot name="pageHeading">
        Detail Buku
    </x-slot>

    <x-slot name="pageDescription">
        Informasi lengkap mengenai buku {{ $book->title }}.
    </x-slot>

    <div class="grid gap-8 md:grid-cols-[1fr_1.2fr]">
        <div
            class="rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-[0_20px_50px_-25px_rgba(15,23,42,0.35)]">
            <div class="aspect-[3/4] overflow-hidden rounded-3xl border border-slate-200 bg-slate-100">
                @if ($book->cover_image_path)
                    <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Sampul {{ $book->title }}"
                        class="h-full w-full object-cover" />
                @else
                    <div class="flex h-full w-full items-center justify-center text-sm font-semibold text-slate-400">
                        Belum ada sampul</div>
                @endif
            </div>
            <div class="mt-6 flex items-center justify-between">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">
                    Stok: {{ $book->quantity }}
                </span>
                <a href="{{ route('admin.books.edit', $book) }}"
                    class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-indigo-50 px-4 py-1.5 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-100">
                    <span class="material-symbols-rounded text-base">edit</span>
                    Edit
                </a>
            </div>
        </div>

        <div
            class="rounded-3xl border border-slate-200/80 bg-white/95 p-8 shadow-[0_20px_50px_-25px_rgba(15,23,42,0.35)] space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">{{ $book->title }}</h2>
                <p class="mt-1 text-sm text-slate-500">Karya {{ $book->author ?? 'Penulis tidak diketahui' }}</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2 text-sm text-slate-600">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Kategori</p>
                    <p class="mt-1 font-medium">{{ $book->category }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Slug</p>
                    <p class="mt-1 font-mono text-xs text-slate-500">{{ $book->slug }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Ditambahkan</p>
                    <p class="mt-1">{{ $book->created_at->translatedFormat('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Terakhir diperbarui</p>
                    <p class="mt-1">{{ $book->updated_at->translatedFormat('d M Y H:i') }}</p>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400">Deskripsi</p>
                <p class="mt-2 leading-relaxed text-slate-600">{{ $book->description }}</p>
            </div>



            <div class="flex items-center gap-3">
                <a href="{{ route('admin.books.index') }}"
                    class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Kembali
                </a>
                <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-2xl bg-rose-500 px-5 py-2 text-sm font-semibold text-white transition hover:bg-rose-400">
                        <span class="material-symbols-rounded text-base">delete</span>
                        Hapus Buku
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
