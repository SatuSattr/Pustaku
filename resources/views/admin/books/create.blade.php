<x-app-layout>
    <x-slot name="pageHeading">
        Tambah Buku Baru
    </x-slot>

    <x-slot name="pageDescription">
        Isi detail buku secara lengkap agar siswa mudah mengenalinya.
    </x-slot>

    <div class="rounded-3xl border border-slate-200/80 bg-white/95 p-8 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)]">
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
            @csrf

            <div class="md:col-span-2">
                <label for="title" class="text-sm font-semibold text-slate-700">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Misal: Belajar Laravel Modern" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <label for="author" class="text-sm font-semibold text-slate-700">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author') }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Nama penulis" />
                <x-input-error :messages="$errors->get('author')" class="mt-2" />
            </div>

            <div>
                <label for="category" class="text-sm font-semibold text-slate-700">Kategori</label>
                <input type="text" id="category" name="category" value="{{ old('category') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Contoh: Teknologi" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <div>
                <label for="quantity" class="text-sm font-semibold text-slate-700">Jumlah Stok</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="0" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <label for="cover" class="text-sm font-semibold text-slate-700">Gambar Sampul</label>
                <input type="file" id="cover" name="cover" accept="image/*" required class="mt-2 w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <p class="mt-2 text-xs text-slate-400">Format jpeg, png. Maksimal 2MB.</p>
                <x-input-error :messages="$errors->get('cover')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <label for="description" class="text-sm font-semibold text-slate-700">Deskripsi Buku</label>
                <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Ceritakan ringkasan menarik mengenai isi buku...">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="md:col-span-2 flex items-center justify-end gap-3">
                <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">
                    <span class="material-symbols-rounded text-base">save</span>
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
