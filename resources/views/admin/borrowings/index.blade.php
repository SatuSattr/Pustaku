<x-app-layout>
    <x-slot name="pageHeading">
        Data Peminjaman Buku
    </x-slot>

    <x-slot name="pageDescription">
        Pantau seluruh proses peminjaman, ubah status, dan kembalikan stok buku secara real-time.
    </x-slot>

    <div class="rounded-3xl border border-slate-200/80 bg-white/95 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Peminjam</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Judul Buku</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Jumlah</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Tanggal Pinjam</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Tanggal Kembali</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($borrowings as $borrowing)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-4 py-4 text-xs font-semibold text-slate-500">{{ $loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage() }}</td>
                            <td class="px-4 py-4">
                                <p class="font-medium text-slate-700">{{ $borrowing->borrower_name }}</p>
                                <p class="text-xs text-slate-500">{{ $borrowing->user->username }}</p>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $borrowing->book->title }}</td>
                            <td class="px-4 py-4 text-center text-sm font-semibold text-slate-700">{{ $borrowing->quantity }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold capitalize
                                    @if($borrowing->status === 'processing') bg-amber-50 text-amber-600 border border-amber-200
                                    @elseif($borrowing->status === 'borrowed') bg-sky-50 text-sky-600 border border-sky-200
                                    @else bg-emerald-50 text-emerald-600 border border-emerald-200 @endif">
                                    <span class="material-symbols-rounded text-sm">progress_activity</span>
                                    {{ $borrowing->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-500">{{ $borrowing->borrowed_at->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-4 text-xs text-slate-500">{{ $borrowing->return_date->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-4">
                                <form method="POST" action="{{ route('admin.borrowings.update', $borrowing) }}" class="flex flex-col gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="rounded-2xl border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}" @selected(old('status', $borrowing->status) === $status)>{{ \App\Models\Borrowing::statusLabels()[$status] ?? ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-indigo-500">
                                        <span class="material-symbols-rounded text-base">sync</span>
                                        Ubah Status
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        {{ $borrowings->links() }}
    </div>
</x-app-layout>
