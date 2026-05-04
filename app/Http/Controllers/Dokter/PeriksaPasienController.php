<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriksaPasienController extends Controller
{
    /**
     * Tampilkan daftar pasien yang belum diperiksa
     */
    public function index()
    {
        $pasien = DaftarPoli::with('pasien')
            ->whereHas('jadwalPeriksa', function ($query) {
                $query->where('id_dokter', Auth::id());
            })
            ->where('status_periksa', 0)
            ->get();

        return view('dokter.periksa.index', compact('pasien'));
    }

    /**
     * Form pemeriksaan pasien
     */
    public function edit($id)
    {
        $daftarPoli = DaftarPoli::with('pasien')->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.create', compact('daftarPoli', 'obats'));
    }

    /**
     * Simpan hasil pemeriksaan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan'     => 'required|string',
            'obat_ids'    => 'required|array',
            'obat_ids.*'  => 'exists:obat,id',
        ]);

        $daftarPoli = DaftarPoli::findOrFail($id);

        DB::beginTransaction();
        try {
            // 1. Hitung biaya periksa (150.000 + harga obat)
            $totalHargaObat = Obat::whereIn('id', $request->obat_ids)->sum('harga');
            $biayaPeriksa = 150000 + $totalHargaObat;

            // 2. Simpan ke tabel periksa
            $periksa = Periksa::create([
                'id_daftar_poli' => $id,
                'tgl_periksa'    => $request->tgl_periksa,
                'catatan'        => $request->catatan,
                'biaya_periksa'  => $biayaPeriksa,
            ]);

            // 3. Simpan ke tabel detail_periksa
            foreach ($request->obat_ids as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat'    => $obatId,
                ]);
            }

            // 4. Update status_periksa di daftar_poli
            $daftarPoli->update(['status_periksa' => 1]);

            DB::commit();
            return redirect()->route('dokter.periksa.index')->with('success', 'Pasien berhasil diperiksa!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
