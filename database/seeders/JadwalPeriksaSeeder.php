<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JadwalPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua dokter
        $dokters = User::where('role', 'dokter')->get();

        $jadwalList = [
            ['hari' => 'Senin',  'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
            ['hari' => 'Selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
            ['hari' => 'Rabu',   'jam_mulai' => '13:00', 'jam_selesai' => '17:00'],
            ['hari' => 'Kamis',  'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
            ['hari' => 'Jumat',  'jam_mulai' => '13:00', 'jam_selesai' => '17:00'],
            ['hari' => 'Sabtu',  'jam_mulai' => '08:00', 'jam_selesai' => '11:00'],
        ];

        $rows = [];
        foreach ($dokters as $dokter) {
            // Setiap dokter dapat 2-3 jadwal berbeda
            $assigned = collect($jadwalList)->random(2);
            foreach ($assigned as $jadwal) {
                $rows[] = [
                    'id_dokter'    => $dokter->id,
                    'hari'         => $jadwal['hari'],
                    'jam_mulai'    => $jadwal['jam_mulai'],
                    'jam_selesai'  => $jadwal['jam_selesai'],
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
        }

        DB::table('jadwal_periksa')->insert($rows);
    }
}
