<x-app-layout>
    <x-slot name="pageHeading">
        Kelola Koleksi Buku
    </x-slot>

    <x-slot name="pageDescription">
        Tambah, perbarui, atau hapus informasi buku yang tersedia di perpustakaan.
    </x-slot>

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Daftar Buku</h2>
            <p class="text-sm text-slate-500">Total {{ $books->total() }} buku terdaftar.</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">
            <span class="material-symbols-rounded text-base">add</span>
            Tambah Buku Baru
        </a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)]">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">No</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">Buku</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">Kategori</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">Gambar</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">Stok</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">Deskripsi</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($books as $book)
                    <tr class="hover:bg-slate-50/60">
                        <td class="px-4 py-4 text-xs font-semibold text-slate-500">{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                        <td class="px-4 py-4">
                            <p class="font-semibold text-slate-800">{{ $book->title }}</p>
                            <p class="text-xs text-slate-500">{{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                        </td>
                        <td class="px-4 py-4 text-xs font-medium text-slate-600">{{ $book->category }}</td>
                        <td class="px-4 py-4">
                            <div class="h-16 w-16 overflow-hidden rounded-xl border border-slate-200 bg-slate-100">
                                @if ($book->cover_image_path)
                                    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-[10px] font-semibold text-slate-400">No Cover</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-4 text-center text-sm font-semibold {{ $book->quantity > 0 ? 'text-emerald-600' : 'text-rose-500' }}">{{ $book->quantity }}</td>
                        <td class="px-4 py-4 text-xs text-slate-500">
                            <p class="max-w-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($book->description, 120) }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-indigo-200 px-3 py-1 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-50">
                                    <span class="material-symbols-rounded text-base">edit</span>
                                    Edit
                                </a>
                                <a href="{{ route('admin.books.show', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:bg-slate-100">
                                    <span class="material-symbols-rounded text-base">visibility</span>
                                    Detail
                                </a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-rose-500 px-3 py-1 text-xs font-semibold text-white transition hover:bg-rose-400">
                                        <span class="material-symbols-rounded text-base">delete</span>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada data buku. Tambahkan buku pertama Anda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $books->links() }}
    </div>
</x-app-layout>
