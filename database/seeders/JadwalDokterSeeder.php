<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JadwalDokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = User::where('role', 'dokter')->get();

        $jadwalOptions = [
            ['hari' => 'Senin',  'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'kuota' => 15],
            ['hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'kuota' => 15],
            ['hari' => 'Rabu',   'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'kuota' => 12],
            ['hari' => 'Kamis',  'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'kuota' => 15],
            ['hari' => 'Jumat',  'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'kuota' => 10],
            ['hari' => 'Sabtu',  'jam_mulai' => '08:00:00', 'jam_selesai' => '11:00:00', 'kuota' => 8],
        ];

        $rows = [];
        foreach ($dokters as $dokter) {
            $assigned = collect($jadwalOptions)->random(3);
            foreach ($assigned as $jadwal) {
                $rows[] = [
                    'user_id'      => $dokter->id,
                    'hari'         => $jadwal['hari'],
                    'jam_mulai'    => $jadwal['jam_mulai'],
                    'jam_selesai'  => $jadwal['jam_selesai'],
                    'kuota'        => $jadwal['kuota'],
                    'status'       => 'aktif',
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
        }

        DB::table('jadwal_dokters')->insert($rows);
    }
}
