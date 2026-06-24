<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Obat;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;

class RiwayatSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Update existing default 'Pasien' to have a valid no_rm, alamat, no_hp
        $defaultPasien = User::where('email', 'pasien@gmail.com')->first();
        if ($defaultPasien) {
            $defaultPasien->update([
                'no_rm'  => '202606-001',
                'alamat' => 'Jl. Pemuda No. 12, Semarang',
                'no_hp'  => '085712345678',
            ]);
        }

        // 2. Add more realistic pasien users
        $newPasiens = [
            [
                'nama'     => 'Budi Santoso',
                'email'    => 'budi.santoso@gmail.com',
                'password' => Hash::make('pasien123'),
                'role'     => 'pasien',
                'alamat'   => 'Jl. Pahlawan No. 45, Semarang',
                'no_hp'    => '081234567890',
                'no_rm'    => '202606-002',
            ],
            [
                'nama'     => 'Siti Aminah',
                'email'    => 'siti.aminah@gmail.com',
                'password' => Hash::make('pasien123'),
                'role'     => 'pasien',
                'alamat'   => 'Jl. Gajah Mada No. 8, Semarang',
                'no_hp'    => '082345678901',
                'no_rm'    => '202606-003',
            ],
            [
                'nama'     => 'Joko Susilo',
                'email'    => 'joko.susilo@gmail.com',
                'password' => Hash::make('pasien123'),
                'role'     => 'pasien',
                'alamat'   => 'Jl. Sudirman No. 102, Semarang',
                'no_hp'    => '083456789012',
                'no_rm'    => '202606-004',
            ],
            [
                'nama'     => 'Rini Astuti',
                'email'    => 'rini.astuti@gmail.com',
                'password' => Hash::make('pasien123'),
                'role'     => 'pasien',
                'alamat'   => 'Jl. Pandanaran No. 56, Semarang',
                'no_hp'    => '084567890123',
                'no_rm'    => '202606-005',
            ],
        ];

        foreach ($newPasiens as $pasienData) {
            User::create($pasienData);
        }

        // 3. Fetch all patients
        $pasiens = User::where('role', 'pasien')->get();

        // 4. Fetch all available jadwal_periksa
        $jadwals = JadwalPeriksa::all();
        if ($jadwals->isEmpty()) {
            return;
        }

        // 5. Fetch some drugs
        $obats = Obat::all();
        if ($obats->isEmpty()) {
            return;
        }

        // 6. Pre-defined checkup complaints and doctor notes
        $complaintsAndNotes = [
            [
                'keluhan' => 'Demam tinggi selama 3 hari disertai batuk kering.',
                'catatan' => 'Pasien didiagnosis flu/ispa ringan. Disarankan bedrest selama 3 hari, banyak minum air putih hangat, serta minum obat teratur.',
            ],
            [
                'keluhan' => 'Sakit gigi berlubang bagian geraham bawah dan ngilu saat makan.',
                'catatan' => 'Gigi berlubang cukup dalam di geraham bawah kanan. Dilakukan sterilisasi dan pembersihan kavitas. Resep pereda nyeri dan antibiotik jika bengkak.',
            ],
            [
                'keluhan' => 'Nyeri dada sebelah kiri terkadang menjalar ke punggung.',
                'catatan' => 'Diperlukan pemeriksaan ECG lebih lanjut. Sementara diberikan obat anti-hipertensi dan pengencer darah. Kurangi makanan berkolesterol tinggi.',
            ],
            [
                'keluhan' => 'Kulit gatal-gatal kemerahan di area lengan dan paha setelah makan seafood.',
                'catatan' => 'Alergi makanan (seafood). Diberikan antihistamin untuk mengurangi gatal dan salep kortikosteroid tipis-tipis.',
            ],
            [
                'keluhan' => 'Sakit kepala hebat di bagian belakang (migren) dan tengkuk terasa kaku.',
                'catatan' => 'Tekanan darah agak tinggi (140/90). Diberikan parasetamol untuk meredakan migren serta vitamin neurotropik.',
            ]
        ];

        // 7. Seed completed checkups
        foreach ($pasiens as $index => $pasien) {
            // Assign 1-2 checkups per patient
            $numCheckups = rand(1, 2);

            for ($i = 0; $i < $numCheckups; $i++) {
                $randomJadwal = $jadwals->random();
                $case = $complaintsAndNotes[rand(0, count($complaintsAndNotes) - 1)];

                // Create Daftar Poli
                $daftarPoli = DaftarPoli::create([
                    'id_pasien'      => $pasien->id,
                    'id_jadwal'      => $randomJadwal->id,
                    'keluhan'        => $case['keluhan'],
                    'no_antrian'     => rand(1, 15),
                    'status_periksa' => 1, // sudah diperiksa
                ]);

                // Choose 1-3 random drugs
                $selectedObats = $obats->random(rand(1, 3));
                $totalHargaObat = $selectedObats->sum('harga');
                $biayaPeriksa = 150000 + $totalHargaObat; // Base fee is Rp 150.000 + drug prices

                // Create Periksa
                $periksa = Periksa::create([
                    'id_daftar_poli' => $daftarPoli->id,
                    'tgl_periksa'    => now()->subDays(rand(1, 20))->subHours(rand(1, 12)),
                    'catatan'        => $case['catatan'],
                    'biaya_periksa'  => $biayaPeriksa,
                ]);

                // Create Detail Periksa (prescriptions)
                foreach ($selectedObats as $obat) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat'    => $obat->id,
                    ]);
                }
            }
        }
    }
}
