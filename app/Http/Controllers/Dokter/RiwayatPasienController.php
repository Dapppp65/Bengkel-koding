<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JadwalPeriksa;

class RiwayatPasienController extends Controller
{
    /**
     * Tampilkan daftar semua pasien di sistem
     */
    public function index()
    {
        $pasien = User::where('role', 'pasien')->get();

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

    /**
     * Daftarkan pasien untuk periksa langsung (walk-in) dan arahkan ke form pemeriksaan
     */
    public function tambahRiwayat($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);

        // Ambil jadwal dokter ini yang pertama kali ditemukan
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::id())->first();

        if (!$jadwal) {
            return back()->with('error', 'Anda belum memiliki jadwal periksa. Silakan buat jadwal dokter terlebih dahulu.');
        }

        // Tentukan nomor antrean berikutnya untuk jadwal ini
        $lastAntrian = DaftarPoli::where('id_jadwal', $jadwal->id)->max('no_antrian') ?? 0;
        $nextAntrian = $lastAntrian + 1;

        // Buat pendaftaran periksa baru (status_periksa = 0)
        $daftarPoli = DaftarPoli::create([
            'id_pasien'      => $pasien->id,
            'id_jadwal'      => $jadwal->id,
            'keluhan'        => 'Pemeriksaan langsung oleh dokter (Walk-in)',
            'no_antrian'     => $nextAntrian,
            'status_periksa' => 0,
        ]);

        // Redirect ke form pemeriksaan dengan status from_riwayat agar kembali ke halaman riwayat setelah selesai
        return redirect()->route('dokter.periksa.edit', ['id' => $daftarPoli->id, 'from_riwayat' => 1])
            ->with('success', 'Pendaftaran periksa berhasil dibuat. Silakan masukkan hasil pemeriksaan.');
    }
}
