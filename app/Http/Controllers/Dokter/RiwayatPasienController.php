<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPasienController extends Controller
{
    /**
     * Tampilkan daftar pasien yang pernah diperiksa oleh dokter ini
     */
    public function index()
    {
        // Ambil pasien (User role=pasien) yang pernah daftar di poli dokter ini
        $pasien = User::where('role', 'pasien')
            ->whereHas('daftarPoli', function ($query) {
                $query->whereHas('jadwalPeriksa', function ($q) {
                    $q->where('id_dokter', Auth::id());
                });
            })->get();

        return view('dokter.riwayat.index', compact('pasien'));
    }

    /**
     * Tampilkan detail riwayat pemeriksaan pasien
     */
    public function show($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        
        $riwayat = DaftarPoli::with(['periksas.detailPeriksas.obat', 'jadwalPeriksa.dokter'])
            ->where('id_pasien', $id)
            ->where('status_periksa', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dokter.riwayat.show', compact('pasien', 'riwayat'));
    }
}
