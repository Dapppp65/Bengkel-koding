<x-layouts.app title="Dashboard Pasien">
    <div class="px-6 py-6 max-w-7xl mx-auto">

        {{-- Welcome & Banner Header --}}
        <div class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 rounded-3xl p-6 md:p-8 text-white shadow-lg mb-8 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute right-20 top-0 w-24 h-24 bg-indigo-400/20 rounded-full blur-xl"></div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-md flex items-center justify-center text-3xl font-black shadow-inner">
                        {{ strtoupper(substr($pasien->nama, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black tracking-tight">Halo, Selamat Datang!</h1>
                        <p class="text-indigo-100 text-sm mt-1 font-medium">
                            {{ $pasien->nama }} &bull; Rekam Medis: 
                            <span class="bg-white/20 px-2 py-0.5 rounded text-xs font-bold font-mono tracking-wider ml-1">
                                {{ $pasien->no_rm ?? 'Membuat...' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-2xl border border-white/10 text-right">
                    <p class="text-xs text-indigo-200 font-semibold uppercase tracking-widest">Hari Ini</p>
                    <p class="text-lg font-bold mt-0.5">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Side: Profile & Registration form --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Profile Card --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-id-card text-indigo-600"></i>
                            Informasi Pasien
                        </h2>
                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-lg border border-indigo-100">
                            Pasien Aktif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase">Nama Lengkap</span>
                            <p class="font-bold text-slate-700">{{ $pasien->nama }}</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase">Nomor Rekam Medis (RM)</span>
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-indigo-600 text-base" id="rmNumber">{{ $pasien->no_rm ?? '-' }}</span>
                                <button onclick="copyRM()" class="text-slate-400 hover:text-indigo-600 transition" title="Salin RM">
                                    <i class="fas fa-copy text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase">No. KTP</span>
                            <p class="font-medium text-slate-700">{{ $pasien->no_ktp ?? '-' }}</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase">No. Handphone</span>
                            <p class="font-medium text-slate-700">{{ $pasien->no_hp ?? '-' }}</p>
                        </div>
                        <div class="sm:col-span-2 space-y-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase">Alamat Rumah</span>
                            <p class="font-medium text-slate-600">{{ $pasien->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Registration Form --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="pb-3 mb-5 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-file-medical text-indigo-600"></i>
                            Pendaftaran Pemeriksaan Baru
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Daftarkan diri Anda ke poli klinik dokter spesialis kami.</p>
                    </div>

                    <form action="{{ route('pasien.daftar') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Pilih Poli --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Poli Klinik <span class="text-red-500">*</span></label>
                                <select id="poli_select" class="w-full border-2 rounded-xl p-3 focus:border-indigo-600 focus:outline-none bg-slate-50 text-sm font-medium transition" required>
                                    <option value="">-- Pilih Poli --</option>
                                    @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pilih Dokter --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Dokter <span class="text-red-500">*</span></label>
                                <select id="dokter_select" class="w-full border-2 rounded-xl p-3 focus:border-indigo-600 focus:outline-none bg-slate-50 text-sm font-medium transition" disabled required>
                                    <option value="">-- Pilih Dokter --</option>
                                </select>
                            </div>
                        </div>

                        {{-- Pilih Jadwal --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Jadwal Dokter <span class="text-red-500">*</span></label>
                            <select id="jadwal_select" name="id_jadwal" class="w-full border-2 rounded-xl p-3 focus:border-indigo-600 focus:outline-none bg-slate-50 text-sm font-medium transition" disabled required>
                                <option value="">-- Pilih Jadwal --</option>
                            </select>
                        </div>

                        {{-- Keluhan --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Keluhan Utama <span class="text-red-500">*</span></label>
                            <textarea name="keluhan" rows="3" placeholder="Tuliskan keluhan atau gejala sakit yang Anda rasakan secara singkat..." class="w-full border-2 rounded-xl p-3 focus:border-indigo-600 focus:outline-none bg-slate-50 text-sm transition" required></textarea>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-sm">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pendaftaran
                        </button>
                    </form>
                </div>

            </div>

            {{-- Right Side: Active Ticket --}}
            <div class="lg:col-span-1 space-y-8">
                
                {{-- Active Tickets Section --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 relative overflow-hidden">
                    <div class="pb-3 mb-5 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-ticket text-indigo-600"></i>
                            Antrean Anda
                        </h2>
                    </div>

                    @forelse($antreanAktif as $antrean)
                    <div class="space-y-4">
                        {{-- Printable Ticket Card --}}
                        <div id="ticket-card-{{ $antrean->id }}" class="bg-slate-50 border-2 border-indigo-100 rounded-2xl p-5 shadow-inner relative">
                            {{-- Side circles for ticket aesthetic --}}
                            <div class="absolute -left-3.5 top-1/2 -translate-y-1/2 w-7 h-7 bg-white rounded-full border-r-2 border-indigo-100"></div>
                            <div class="absolute -right-3.5 top-1/2 -translate-y-1/2 w-7 h-7 bg-white rounded-full border-l-2 border-indigo-100"></div>
                            
                            {{-- Header --}}
                            <div class="text-center pb-3 border-b-2 border-dashed border-indigo-100 mb-4">
                                <p class="text-xs font-extrabold uppercase text-indigo-600 tracking-wider">Klinik Poliklinik</p>
                                <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Struk Antrean Pendaftaran</p>
                            </div>

                            {{-- Queue Number --}}
                            <div class="text-center my-4">
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wide">Nomor Antrean</span>
                                <h3 class="text-5xl font-black text-indigo-600 mt-1" id="antreanNumber">
                                    {{ sprintf('%02d', $antrean->no_antrian) }}
                                </h3>
                                <span class="inline-flex items-center gap-1 mt-2.5 px-2.5 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold uppercase rounded-full border border-amber-200 animate-pulse">
                                    <i class="fas fa-clock text-[9px]"></i>
                                    Menunggu Antrean
                                </span>
                            </div>

                            {{-- Ticket Detail --}}
                            <div class="text-xs text-slate-700 space-y-2 pt-2">
                                <div class="flex justify-between">
                                    <span class="text-slate-400 font-medium">Poli Klinik:</span>
                                    <span class="font-bold text-slate-800">{{ $antrean->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400 font-medium">Dokter:</span>
                                    <span class="font-bold text-slate-800">{{ $antrean->jadwalPeriksa->dokter->nama ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400 font-medium">Waktu:</span>
                                    <span class="font-bold text-slate-800">
                                        {{ $antrean->jadwalPeriksa->hari }}, {{ substr($antrean->jadwalPeriksa->jam_mulai, 0, 5) }} - {{ substr($antrean->jadwalPeriksa->jam_selesai, 0, 5) }}
                                    </span>
                                </div>
                                <div class="flex justify-between pt-1 border-t border-slate-100">
                                    <span class="text-slate-400 font-medium">Tgl Daftar:</span>
                                    <span class="text-slate-500 font-mono">{{ $antrean->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <button onclick="printTicket('ticket-card-{{ $antrean->id }}')" class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-slate-800 hover:bg-black text-white text-sm font-semibold rounded-xl transition shadow-sm">
                            <i class="fas fa-print"></i>
                            Cetak Tiket Antrean
                        </button>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-ticket text-slate-300"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Anda belum memiliki antrean aktif.</p>
                        <p class="text-xs text-slate-400 mt-1 px-4">Silakan mendaftar periksa menggunakan formulir di sebelah kiri.</p>
                    </div>
                    @endforelse
                </div>

            </div>

        </div>

        {{-- Examination History Section --}}
        <div class="mt-8 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="pb-3 mb-5 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-history text-indigo-600"></i>
                    Riwayat Kunjungan & Pemeriksaan Medis
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Catatan rekam medis Anda selama berobat di Poliklinik.</p>
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

                <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    {{-- Header Kunjungan --}}
                    <div class="bg-slate-50 px-5 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-indigo-600 text-white text-xs font-black flex items-center justify-center shadow-sm">
                                {{ $loop->iteration }}
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">
                                    Pemeriksaan &bull; {{ $periksa ? \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d F Y') : '-' }}
                                </h4>
                                <p class="text-xs text-slate-400 font-semibold mt-0.5">Poli Klinik: {{ $poli->nama_poli ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-slate-400 font-semibold block uppercase">Total Biaya Periksa</span>
                            <span class="text-base font-black text-indigo-600">
                                Rp {{ number_format($periksa->biaya_periksa ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Konten Kunjungan --}}
                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                        {{-- Keluhan & Diagnosis --}}
                        <div class="md:col-span-2 space-y-4">
                            <div>
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block mb-1">Keluhan Anda</span>
                                <p class="text-slate-700 font-medium leading-relaxed">{{ $r->keluhan }}</p>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block mb-1">Catatan/Diagnosis Dokter</span>
                                <p class="text-slate-700 font-medium leading-relaxed italic bg-indigo-50/30 p-3 rounded-xl border border-indigo-50">
                                    "{{ $periksa->catatan ?? 'Tidak ada catatan dokter.' }}"
                                </p>
                            </div>
                        </div>

                        {{-- Dokter & Resep --}}
                        <div class="md:col-span-1 space-y-4 bg-slate-50/50 p-4 rounded-xl border border-slate-100">
                            <div>
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block mb-1">Dokter Pemeriksa</span>
                                <p class="font-bold text-slate-800">{{ $dokter->nama ?? '-' }}</p>
                            </div>
                            <div class="pt-3 border-t border-slate-200/50">
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block mb-2">Resep Obat</span>
                                <ul class="space-y-1.5 text-xs text-slate-700 font-medium">
                                    @forelse($details as $detail)
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-indigo-600 rounded-full"></span>
                                        <span>{{ $detail->obat->nama_obat ?? '-' }}</span>
                                        <span class="text-[10px] text-slate-400">({{ $detail->obat->kemasan ?? '-' }})</span>
                                    </li>
                                    @empty
                                    <li class="text-slate-400 italic">Tidak ada obat yang diresepkan.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-folder-open text-slate-300 text-xl"></i>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada riwayat kunjungan medis.</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Javascript for dynamic selects & ticket printing --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const poliSelect = document.getElementById('poli_select');
            const dokterSelect = document.getElementById('dokter_select');
            const jadwalSelect = document.getElementById('jadwal_select');

            poliSelect.addEventListener('change', function() {
                const idPoli = this.value;
                
                // Reset dokter & jadwal
                dokterSelect.innerHTML = '<option value="">-- Pilih Dokter --</option>';
                dokterSelect.disabled = true;
                jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
                jadwalSelect.disabled = true;

                if (!idPoli) return;

                fetch(`/pasien/get-dokter/${idPoli}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach(dokter => {
                                dokterSelect.innerHTML += `<option value="${dokter.id}">${dokter.nama}</option>`;
                            });
                            dokterSelect.disabled = false;
                        } else {
                            dokterSelect.innerHTML = '<option value="">Tidak ada dokter tersedia</option>';
                        }
                    })
                    .catch(err => console.error('Gagal mengambil data dokter:', err));
            });

            dokterSelect.addEventListener('change', function() {
                const idDokter = this.value;

                // Reset jadwal
                jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
                jadwalSelect.disabled = true;

                if (!idDokter) return;

                fetch(`/pasien/get-jadwal/${idDokter}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach(jadwal => {
                                jadwalSelect.innerHTML += `<option value="${jadwal.id}">${jadwal.hari} (${jadwal.jam_mulai.substring(0, 5)} - ${jadwal.jam_selesai.substring(0, 5)})</option>`;
                            });
                            jadwalSelect.disabled = false;
                        } else {
                            jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal tersedia</option>';
                        }
                    })
                    .catch(err => console.error('Gagal mengambil data jadwal:', err));
            });
        });

        // Copy RM Number to clipboard
        function copyRM() {
            const rmNumber = document.getElementById('rmNumber').innerText;
            navigator.clipboard.writeText(rmNumber).then(() => {
                alert('Nomor Rekam Medis berhasil disalin: ' + rmNumber);
            }).catch(err => {
                console.error('Gagal menyalin nomor RM:', err);
            });
        }

        // Print Ticket Functionality
        function printTicket(ticketId) {
            const printContent = document.getElementById(ticketId).innerHTML;
            const originalContent = document.body.innerHTML;
            
            document.body.innerHTML = `
                <html>
                    <head>
                        <title>Cetak Tiket Antrean</title>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
                        <style>
                            body { font-family: 'Plus Jakarta Sans', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #fff; margin: 0; padding: 20px; }
                            .ticket-print { border: 2px dashed #4f46e5; padding: 30px; border-radius: 16px; background-color: #f8fafc; max-width: 350px; width: 100%; box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); text-align: center; }
                        </style>
                    </head>
                    <body>
                        <div class="ticket-print">
                            ${printContent}
                        </div>
                    </body>
                </html>
            `;
            
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload();
        }
    </script>
</x-layouts.app>