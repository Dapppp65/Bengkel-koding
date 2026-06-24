<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PoliSeeder::class,           // 1. Data poli dulu (diperlukan oleh dokter)
            UserSeeder::class,           // 2. Admin & pasien default
            DokterSeeder::class,         // 3. Dokter (memerlukan id_poli)
            ObatSeeder::class,           // 4. Data obat
            JadwalPeriksaSeeder::class,  // 5. Jadwal periksa (memerlukan id_dokter)
            JadwalDokterSeeder::class,   // 6. Jadwal dokter (memerlukan user_id dokter)
            RiwayatSeeder::class,        // 7. Riwayat periksa & pasien tambahan
        ]);
    }
}