<x-app-layout>
    <x-slot name="pageHeading">
        Edit Buku
    </x-slot>

    <x-slot name="pageDescription">
        Perbarui informasi buku {{ $book->title }} agar data katalog tetap akurat.
    </x-slot>

    <div class="rounded-3xl border border-slate-200/80 bg-white/95 p-8 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)]">
        <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="md:col-span-2">
                <label for="title" class="text-sm font-semibold text-slate-700">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <label for="author" class="text-sm font-semibold text-slate-700">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <x-input-error :messages="$errors->get('author')" class="mt-2" />
            </div>

            <div>
                <label for="category" class="text-sm font-semibold text-slate-700">Kategori</label>
                <input type="text" id="category" name="category" value="{{ old('category', $book->category) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <div>
                <label for="quantity" class="text-sm font-semibold text-slate-700">Jumlah Stok</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Sampul Saat Ini</label>
                <div class="mt-2 h-40 w-full overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                    @if ($book->cover_image_path)
                        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                    @else
                        <div class="flex h-full w-full items-center justify-center text-xs font-semibold text-slate-400">Belum ada gambar</div>
                    @endif
                </div>
            </div>

            <div>
                <label for="cover" class="text-sm font-semibold text-slate-700">Ganti Sampul</label>
                <input type="file" id="cover" name="cover" accept="image/*" class="mt-2 w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <p class="mt-2 text-xs text-slate-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                <x-input-error :messages="$errors->get('cover')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <label for="description" class="text-sm font-semibold text-slate-700">Deskripsi Buku</label>
                <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200">{{ old('description', $book->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="md:col-span-2 flex items-center justify-end gap-3">
                <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Kembali
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">
                    <span class="material-symbols-rounded text-base">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
