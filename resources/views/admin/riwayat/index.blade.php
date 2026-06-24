<x-layouts.app title="Riwayat Pasien">
    <div class="px-6 py-4">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Pasien</h1>
            <p class="text-slate-500 text-sm mt-1">Rekam medis semua pasien yang telah diperiksa.</p>
        </div>

        {{-- Stats Summary --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-6 py-4 flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-users text-indigo-600"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Pasien</p>
                    <p class="text-2xl font-black text-slate-800">{{ $pasiens->count() }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-6 py-4 flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Kunjungan</p>
                    <p class="text-2xl font-black text-slate-800">{{ $pasiens->sum('jumlah_kunjungan') }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-6 py-4 flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-chart-line text-amber-600"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Rata-rata Kunjungan</p>
                    <p class="text-2xl font-black text-slate-800">
                        {{ $pasiens->count() ? number_format($pasiens->avg('jumlah_kunjungan'), 1) : '0' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Nama Pasien</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No. RM</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No. HP</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Alamat</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Kunjungan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pasiens as $index => $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold shrink-0">
                                        {{ strtoupper(substr($p->nama, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-slate-800">{{ $p->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded uppercase">
                                    {{ $p->no_rm ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->no_hp ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->alamat ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-indigo-100 text-indigo-700 text-xs font-black">
                                    {{ $p->jumlah_kunjungan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.riwayat.show', $p->id) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-all shadow-sm">
                                    <i class="fas fa-history"></i>
                                    Lihat Riwayat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-folder-open text-3xl text-slate-300"></i>
                                    <p class="text-slate-400 font-medium">Belum ada data riwayat pasien.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
