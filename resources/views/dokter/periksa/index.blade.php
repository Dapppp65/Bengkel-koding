<x-layouts.app title="Daftar Pasien Diperiksa">
    <div class="px-6 py-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Daftar Pasien Diperiksa</h1>
            <p class="text-slate-500">Kelola antrian pasien yang perlu diperiksa hari ini.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">No Antrian</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Nama Pasien</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Keluhan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pasien as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold text-sm">
                                    {{ $p->no_antrian }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-700 font-medium">{{ $p->pasien->nama }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ Str::limit($p->keluhan, 50) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('dokter.periksa.edit', $p->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm shadow-indigo-200">
                                    <i class="fas fa-stethoscope"></i>
                                    Periksa
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i class="fas fa-user-clock text-2xl"></i>
                                    </div>
                                    <p class="text-slate-500 font-medium">Tidak ada antrian pasien saat ini.</p>
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
