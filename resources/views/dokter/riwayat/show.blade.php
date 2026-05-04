<x-layouts.app title="Detail Riwayat Pasien">
    <div class="px-6 py-4">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('dokter.riwayat.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:text-indigo-600 hover:border-indigo-200 transition-all">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail Riwayat: {{ $pasien->nama }}</h1>
                <p class="text-slate-500">Rekam medis lengkap untuk No. RM: {{ $pasien->no_rm ?? '-' }}</p>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($riwayat as $r)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">
                                {{ \Carbon\Carbon::parse($r->periksas->first()->tgl_periksa ?? $r->created_at)->format('d F Y') }}
                            </p>
                            <p class="text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($r->periksas->first()->tgl_periksa ?? $r->created_at)->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold uppercase text-slate-400">Total Biaya</p>
                        <p class="text-lg font-black text-slate-800">
                            Rp {{ number_format($r->periksas->first()->biaya_periksa ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">Diagnosa / Catatan</h4>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 text-slate-700 leading-relaxed">
                            {{ $r->periksas->first()->catatan ?? 'Tidak ada catatan.' }}
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">Obat yang Diberikan</h4>
                        <div class="space-y-2">
                            @php
                                $periksa = $r->periksas->first();
                                $details = $periksa ? $periksa->detailPeriksas : collect();
                            @endphp
                            
                            @forelse($details as $detail)
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $detail->obat->nama_obat }}</p>
                                    <p class="text-xs text-slate-500">{{ $detail->obat->kemasan }}</p>
                                </div>
                            </div>
                            @empty
                            <p class="text-sm text-slate-400 italic text-center py-4">Tidak ada obat yang diresepkan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
                <p class="text-slate-500">Belum ada riwayat pemeriksaan untuk pasien ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
