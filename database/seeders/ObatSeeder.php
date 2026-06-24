<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obats = [
            ['nama_obat' => 'Paracetamol 500mg',       'kemasan' => 'Tablet',    'harga' => 5000],
            ['nama_obat' => 'Amoxicillin 500mg',        'kemasan' => 'Kapsul',    'harga' => 12000],
            ['nama_obat' => 'Ibuprofen 400mg',           'kemasan' => 'Tablet',    'harga' => 8000],
            ['nama_obat' => 'Antasida Doen',             'kemasan' => 'Tablet',    'harga' => 4000],
            ['nama_obat' => 'Cetirizine 10mg',           'kemasan' => 'Tablet',    'harga' => 6000],
            ['nama_obat' => 'Metformin 500mg',           'kemasan' => 'Tablet',    'harga' => 9000],
            ['nama_obat' => 'Amlodipine 5mg',            'kemasan' => 'Tablet',    'harga' => 11000],
            ['nama_obat' => 'Omeprazole 20mg',           'kemasan' => 'Kapsul',    'harga' => 15000],
            ['nama_obat' => 'Salbutamol 4mg',            'kemasan' => 'Tablet',    'harga' => 7000],
            ['nama_obat' => 'Vitamin C 500mg',           'kemasan' => 'Tablet',    'harga' => 3000],
            ['nama_obat' => 'Dexamethasone 0.5mg',       'kemasan' => 'Tablet',    'harga' => 5500],
            ['nama_obat' => 'Simvastatin 20mg',          'kemasan' => 'Tablet',    'harga' => 13000],
            ['nama_obat' => 'Clopidogrel 75mg',          'kemasan' => 'Tablet',    'harga' => 25000],
            ['nama_obat' => 'Loratadine 10mg',           'kemasan' => 'Tablet',    'harga' => 6500],
            ['nama_obat' => 'Sirup OBH Combi',           'kemasan' => 'Botol',     'harga' => 22000],
            ['nama_obat' => 'Betadine Antiseptik',       'kemasan' => 'Botol',     'harga' => 18000],
            ['nama_obat' => 'Antimo',                    'kemasan' => 'Tablet',    'harga' => 4500],
            ['nama_obat' => 'Neurobion 5000',            'kemasan' => 'Ampul',     'harga' => 35000],
            ['nama_obat' => 'Kloramfenikol Salep Mata',  'kemasan' => 'Tube',      'harga' => 16000],
            ['nama_obat' => 'Glibenklamid 5mg',          'kemasan' => 'Tablet',    'harga' => 8500],
        ];

        DB::table('obat')->insert($obats);
    }
}
