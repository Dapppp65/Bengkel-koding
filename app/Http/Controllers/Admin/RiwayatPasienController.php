<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use Illuminate\Support\Facades\DB;

class RiwayatPasienController extends Controller
{
    /**
     * Daftar semua pasien yang memiliki riwayat periksa
     */
    public function index()
    {
        $pasiens = User::where('role', 'pasien')
            ->whereHas('daftarPoli', function ($q) {
                $q->where('status_periksa', 1);
            })
            ->withCount(['daftarPoli as jumlah_kunjungan' => function ($q) {
                $q->where('status_periksa', 1);
            }])
            ->get();

        return view('admin.riwayat.index', compact('pasiens'));
    }

    /**
     * Detail riwayat periksa satu pasien
     */
    public function show($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);

        $riwayat = DaftarPoli::with([
                'periksas.detailPeriksas.obat',
                'jadwalPeriksa.dokter.poli',
            ])
            ->where('id_pasien', $id)
            ->where('status_periksa', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.riwayat.show', compact('pasien', 'riwayat'));
    }

    /**
     * Hapus satu entri riwayat periksa (daftar_poli + periksa + detail_periksa)
     */
    public function destroy($daftarPoliId)
    {
        $daftarPoli = DaftarPoli::findOrFail($daftarPoliId);
        $pasienId   = $daftarPoli->id_pasien;

        DB::beginTransaction();
        try {
            // Hapus detail_periksa dan periksa terkait
            $periksa = Periksa::where('id_daftar_poli', $daftarPoliId)->first();
            if ($periksa) {
                DetailPeriksa::where('id_periksa', $periksa->id)->delete();
                $periksa->delete();
            }
            // Reset status daftar_poli ke belum diperiksa
            $daftarPoli->update(['status_periksa' => 0]);

            DB::commit();
            return redirect()->route('admin.riwayat.show', $pasienId)
                ->with('success', 'Riwayat pemeriksaan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus riwayat: ' . $e->getMessage());
        }
    }
}
