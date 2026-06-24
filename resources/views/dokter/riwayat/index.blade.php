<x-layouts.app title="Riwayat Pasien">
    <div class="px-6 py-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Pasien</h1>
            <p class="text-slate-500">Lihat rekam medis pasien yang pernah diperiksa.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Nama Pasien</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Alamat</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No. KTP</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No. HP</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No. RM</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pasien as $index => $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-slate-700 font-medium">{{ $p->nama }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->alamat }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->no_ktp }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->no_hp }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded uppercase">
                                    {{ $p->no_rm ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                <a href="{{ route('dokter.riwayat.show', $p->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-black text-white text-xs font-semibold rounded-xl transition-all shadow-sm">
                                    <i class="fas fa-history"></i>
                                    Detail Riwayat
                                </a>
                                <form action="{{ route('dokter.riwayat.tambah', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition-all shadow-sm">
                                        <i class="fas fa-plus"></i>
                                        Tambah Periksa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <p class="text-slate-500 font-medium">Belum ada data riwayat pasien.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
