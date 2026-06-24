<x-layouts.app title="{{ isset($periksa) ? 'Edit Pemeriksaan Pasien' : 'Periksa Pasien' }}">
    <div class="px-6 py-4">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ request()->get('from_riwayat') ? route('dokter.riwayat.show', $daftarPoli->id_pasien) : route('dokter.periksa.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:text-indigo-600 hover:border-indigo-200 transition-all">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ isset($periksa) ? 'Edit Pemeriksaan Pasien' : 'Periksa Pasien' }}</h1>
                <p class="text-slate-500">Berikan diagnosa dan resep obat untuk pasien.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- FORM --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <form action="{{ route('dokter.periksa.update', $daftarPoli->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="from_riwayat" value="{{ request()->get('from_riwayat') }}">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Pasien</label>
                                <input type="text" value="{{ $daftarPoli->pasien->nama }}" disabled
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-500 focus:outline-none cursor-not-allowed">
                            </div>

                            <div>
                                <label for="tgl_periksa" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Periksa</label>
                                <input type="datetime-local" name="tgl_periksa" id="tgl_periksa" required
                                    value="{{ old('tgl_periksa', isset($periksa) ? \Carbon\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                                    class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                            </div>

                            <div>
                                <label for="catatan" class="block text-sm font-semibold text-slate-700 mb-2">Catatan / Diagnosa</label>
                                <textarea name="catatan" id="catatan" rows="4" required placeholder="Tuliskan diagnosa atau catatan pemeriksaan di sini..."
                                    class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">{{ old('catatan', isset($periksa) ? $periksa->catatan : '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Obat</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @php
                                        $selectedObats = isset($periksa) ? $periksa->detailPeriksas->pluck('id_obat')->toArray() : [];
                                    @endphp
                                    @foreach($obats as $obat)
                                    <label class="relative flex items-center p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/30">
                                        <input type="checkbox" name="obat_ids[]" value="{{ $obat->id }}" 
                                            {{ in_array($obat->id, old('obat_ids', $selectedObats)) ? 'checked' : '' }}
                                            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                                        <div class="ml-3">
                                            <p class="text-sm font-bold text-slate-800">{{ $obat->nama_obat }}</p>
                                            <p class="text-xs text-slate-500">{{ $obat->kemasan }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}</p>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i>
                                {{ isset($periksa) ? 'Update Pemeriksaan' : 'Simpan Pemeriksaan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFO --}}
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-2xl shadow-lg p-6 text-white sticky top-4">
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-circle-info"></i>
                        Informasi Biaya
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-indigo-100">
                            <span>Jasa Dokter</span>
                            <span class="font-bold text-white">Rp 150.000</span>
                        </div>
                        <div class="flex justify-between items-center text-indigo-100">
                            <span>Total Obat</span>
                            <span class="font-bold text-white" id="displayTotalObat">Rp 0</span>
                        </div>
                        <div class="pt-4 border-t border-white/20">
                            <div class="flex justify-between items-center">
                                <span class="font-bold">Total Biaya</span>
                                <span class="text-2xl font-black" id="displayTotalSeluruh">Rp 150.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll('input[name="obat_ids[]"]');
        const displayTotalObat = document.getElementById('displayTotalObat');
        const displayTotalSeluruh = document.getElementById('displayTotalSeluruh');

        function calculateTotal() {
            let totalObat = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const priceText = cb.nextElementSibling.querySelector('.text-slate-500').innerText;
                    const price = parseInt(priceText.match(/Rp\s*([\d.]+)/)[1].replace(/\./g, ''));
                    totalObat += price;
                }
            });

            displayTotalObat.innerText = 'Rp ' + totalObat.toLocaleString('id-ID');
            displayTotalSeluruh.innerText = 'Rp ' + (totalObat + 150000).toLocaleString('id-ID');
        }

        checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));

        // Calculate initial total
        calculateTotal();
    </script>
</x-layouts.app>
