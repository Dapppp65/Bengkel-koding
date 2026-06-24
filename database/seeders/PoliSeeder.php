<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [
            [
                'nama_poli'   => 'Poli Umum',
                'keterangan'  => 'Layanan kesehatan umum untuk berbagai keluhan penyakit ringan hingga sedang.',
            ],
            [
                'nama_poli'   => 'Poli Gigi',
                'keterangan'  => 'Layanan perawatan gigi dan mulut, termasuk pencabutan, penambalan, dan pembersihan karang gigi.',
            ],
            [
                'nama_poli'   => 'Poli Anak',
                'keterangan'  => 'Layanan kesehatan khusus bayi, anak, dan remaja di bawah usia 18 tahun.',
            ],
            [
                'nama_poli'   => 'Poli Kandungan',
                'keterangan'  => 'Layanan kesehatan ibu hamil, persalinan, dan gangguan reproduksi wanita.',
            ],
            [
                'nama_poli'   => 'Poli Jantung',
                'keterangan'  => 'Layanan diagnosis dan penanganan penyakit jantung dan pembuluh darah.',
            ],
            [
                'nama_poli'   => 'Poli Mata',
                'keterangan'  => 'Layanan pemeriksaan dan pengobatan gangguan penglihatan serta penyakit mata.',
            ],
            [
                'nama_poli'   => 'Poli Kulit & Kelamin',
                'keterangan'  => 'Layanan diagnosis dan terapi penyakit kulit, rambut, kuku, dan kelamin.',
            ],
            [
                'nama_poli'   => 'Poli Saraf',
                'keterangan'  => 'Layanan penanganan gangguan sistem saraf pusat dan tepi, termasuk stroke dan migrain.',
            ],
        ];

        DB::table('poli')->insert($polis);
    }
}
