<x-app-layout>
    <x-slot name="pageHeading">
        Riwayat Peminjaman Saya
    </x-slot>

    <x-slot name="pageDescription">
        Lacak status peminjaman dan jadwal pengembalian bukumu di sini.
    </x-slot>

    <div class="rounded-3xl border border-slate-200/80 bg-white/95 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Judul Buku</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Jumlah</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Tanggal Pinjam</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Tanggal Kembali</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-500">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($borrowings as $borrowing)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-4 py-4 text-xs font-semibold text-slate-500">{{ $loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage() }}</td>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-slate-700">{{ $borrowing->book->title }}</p>
                                <p class="text-xs text-slate-500">{{ $borrowing->book->author ?? 'Penulis tidak diketahui' }}</p>
                            </td>
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
                            <td class="px-4 py-4 text-xs text-slate-500">
                                {{ $borrowing->notes ? $borrowing->notes : 'Tidak ada catatan tambahan.' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-sm text-slate-500">Kamu belum pernah meminjam buku. Mulai jelajahi katalog sekarang!</td>
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
