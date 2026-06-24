<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Poli;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil id poli berdasarkan nama
        $poliMap = Poli::pluck('id', 'nama_poli');

        $dokters = [
            [
                'nama'     => 'Dr. Ahmad Fauzi, Sp.U',
                'email'    => 'ahmad.fauzi@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567890',
                'alamat'   => 'Jl. Merdeka No. 10, Jakarta',
                'id_poli'  => $poliMap['Poli Umum'] ?? null,
            ],
            [
                'nama'     => 'Dr. Siti Rahayu, drg.',
                'email'    => 'siti.rahayu@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567891',
                'alamat'   => 'Jl. Sudirman No. 5, Bandung',
                'id_poli'  => $poliMap['Poli Gigi'] ?? null,
            ],
            [
                'nama'     => 'Dr. Budi Santoso, Sp.A',
                'email'    => 'budi.santoso@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567892',
                'alamat'   => 'Jl. Diponegoro No. 22, Surabaya',
                'id_poli'  => $poliMap['Poli Anak'] ?? null,
            ],
            [
                'nama'     => 'Dr. Dewi Lestari, Sp.OG',
                'email'    => 'dewi.lestari@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567893',
                'alamat'   => 'Jl. Gatot Subroto No. 8, Semarang',
                'id_poli'  => $poliMap['Poli Kandungan'] ?? null,
            ],
            [
                'nama'     => 'Dr. Hendra Wijaya, Sp.JP',
                'email'    => 'hendra.wijaya@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567894',
                'alamat'   => 'Jl. Ahmad Yani No. 15, Yogyakarta',
                'id_poli'  => $poliMap['Poli Jantung'] ?? null,
            ],
            [
                'nama'     => 'Dr. Rina Kusuma, Sp.M',
                'email'    => 'rina.kusuma@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567895',
                'alamat'   => 'Jl. Hayam Wuruk No. 3, Medan',
                'id_poli'  => $poliMap['Poli Mata'] ?? null,
            ],
            [
                'nama'     => 'Dr. Fajar Nugroho, Sp.KK',
                'email'    => 'fajar.nugroho@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567896',
                'alamat'   => 'Jl. Pahlawan No. 7, Makassar',
                'id_poli'  => $poliMap['Poli Kulit & Kelamin'] ?? null,
            ],
            [
                'nama'     => 'Dr. Mega Pratiwi, Sp.S',
                'email'    => 'mega.pratiwi@klinik.com',
                'password' => Hash::make('dokter123'),
                'role'     => 'dokter',
                'no_hp'    => '081234567897',
                'alamat'   => 'Jl. Veteran No. 11, Palembang',
                'id_poli'  => $poliMap['Poli Saraf'] ?? null,
            ],
        ];

        foreach ($dokters as $dokter) {
            User::create($dokter);
        }
    }
}
