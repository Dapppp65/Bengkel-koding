<x-layouts.app title="Detail Riwayat Pasien">
    <div class="px-6 py-4">

        {{-- Back button + title --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.riwayat.index') }}"
                   class="w-9 h-9 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:text-indigo-600 hover:border-indigo-300 transition-all shadow-sm">
                    <i class="fas fa-arrow-left text-sm"></i>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Detail Riwayat</h1>
                    <p class="text-sm text-slate-500">
                        {{ $pasien->nama }} &mdash; No. RM: <span class="font-semibold">{{ $pasien->no_rm ?? '-' }}</span>
                    </p>
                </div>
            </div>

            {{-- Summary badge --}}
            <div class="flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-200 rounded-xl">
                <i class="fas fa-clipboard-list text-indigo-500"></i>
                <span class="text-sm font-semibold text-indigo-700">{{ $riwayat->count() }} Kunjungan</span>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($riwayat as $r)
            @php
                $periksa = $r->periksas->first();
                $details = $periksa ? $periksa->detailPeriksas : collect();
                $jadwal  = $r->jadwalPeriksa;
                $dokter  = $jadwal?->dokter;
                $poli    = $dokter?->poli;
            @endphp

            {{-- Kunjungan header bar --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-slate-50 border border-slate-200 px-5 py-3 rounded-xl gap-3">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-indigo-600 text-white text-xs font-black flex items-center justify-center">
                        {{ $loop->iteration }}
                    </span>
                    <span class="text-sm font-bold text-slate-700 flex items-center gap-2">
                        <i class="fas fa-calendar-check text-indigo-600"></i>
                        Kunjungan {{ $periksa ? \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y H:i') : '-' }}
                    </span>
                </div>
                {{-- Hapus Riwayat Button --}}
                <form action="{{ route('admin.riwayat.destroy', $r->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus riwayat pemeriksaan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                        <i class="fas fa-trash-can"></i>
                        Hapus Riwayat
                    </button>
                </form>
            </div>

            {{-- Informasi Pasien --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h2 class="text-sm font-semibold text-slate-700">Informasi Kunjungan</h2>
                </div>
                <div class="px-6 py-5">
                    <table class="text-sm w-full">
                        <tbody>
                            <tr>
                                <td class="py-2 pr-6 text-slate-500 w-44">Nama Pasien</td>
                                <td class="py-2 text-slate-800 font-medium">{{ $pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-6 text-slate-500">No. Antrian</td>
                                <td class="py-2 text-slate-800">{{ $r->no_antrian }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-6 text-slate-500">Keluhan</td>
                                <td class="py-2 text-slate-800">{{ $r->keluhan }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-6 text-slate-500">Poli</td>
                                <td class="py-2 text-indigo-600 font-medium">{{ $poli->nama_poli ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-6 text-slate-500">Dokter</td>
                                <td class="py-2 text-indigo-600 font-medium">{{ $dokter->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-6 text-slate-500">Tanggal Periksa</td>
                                <td class="py-2 text-slate-800">
                                    {{ $periksa ? \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y H:i') : '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Catatan Dokter --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h2 class="text-sm font-semibold text-slate-700">Catatan Dokter</h2>
                </div>
                <div class="px-6 py-5 text-sm text-slate-700 leading-relaxed">
                    {{ $periksa->catatan ?? 'Tidak ada catatan.' }}
                </div>
            </div>

            {{-- Obat yang Diresepkan --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h2 class="text-sm font-semibold text-slate-700">Obat yang Diresepkan</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-slate-400 w-16">#</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-indigo-500">Nama Obat</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-indigo-500">Kemasan</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-indigo-500 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($details as $i => $detail)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-3 text-slate-500">{{ $i + 1 }}</td>
                                <td class="px-6 py-3 text-slate-800 font-medium">{{ $detail->obat->nama_obat ?? '-' }}</td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                                        {{ $detail->obat->kemasan ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-slate-800 text-right font-semibold">
                                    Rp {{ number_format($detail->obat->harga ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-slate-400 italic text-sm">
                                    Tidak ada obat yang diresepkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Total Biaya --}}
                <div class="px-6 py-5 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <i class="fas fa-receipt text-slate-400"></i>
                        <span>Jasa dokter Rp 150.000 + Obat</span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">Total Biaya Periksa</p>
                        <p class="text-2xl font-black text-indigo-600">
                            Rp {{ number_format($periksa->biaya_periksa ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            @if(!$loop->last)
            <div class="border-t border-dashed border-slate-200 my-2"></div>
            @endif

            @empty
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-folder-open text-slate-400 text-xl"></i>
                </div>
                <p class="text-slate-500 font-medium">Belum ada riwayat pemeriksaan untuk pasien ini.</p>
            </div>
            @endforelse
        </div>

    </div>
</x-layouts.app>
