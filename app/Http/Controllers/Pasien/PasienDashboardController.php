<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\User;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard pasien
     */
    public function index()
    {
        $pasien = Auth::user();

        // Antrean Aktif (status_periksa = 0)
        $antreanAktif = DaftarPoli::with(['jadwalPeriksa.dokter.poli'])
            ->where('id_pasien', $pasien->id)
            ->where('status_periksa', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        // Riwayat Pemeriksaan (status_periksa = 1)
        $riwayat = DaftarPoli::with(['periksas.detailPeriksas.obat', 'jadwalPeriksa.dokter.poli'])
            ->where('id_pasien', $pasien->id)
            ->where('status_periksa', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Daftar Poli untuk dropdown registrasi
        $polis = Poli::all();

        return view('pasien.dashboard', compact('pasien', 'antreanAktif', 'riwayat', 'polis'));
    }

    /**
     * Endpoint AJAX untuk mengambil dokter berdasarkan poli
     */
    public function getDokter($idPoli)
    {
        $dokters = User::where('role', 'dokter')
            ->where('id_poli', $idPoli)
            ->select('id', 'nama')
            ->get();

        return response()->json($dokters);
    }

    /**
     * Endpoint AJAX untuk mengambil jadwal periksa berdasarkan dokter
     */
    public function getJadwal($idDokter)
    {
        $jadwals = JadwalPeriksa::where('id_dokter', $idDokter)
            ->select('id', 'hari', 'jam_mulai', 'jam_selesai')
            ->get();

        return response()->json($jadwals);
    }

    /**
     * Daftarkan pemeriksaan (daftar poli) baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan'   => 'required|string',
        ], [
            'id_jadwal.required' => 'Jadwal periksa harus dipilih.',
            'id_jadwal.exists'   => 'Jadwal periksa tidak valid.',
            'keluhan.required'   => 'Keluhan harus diisi.',
        ]);

        $pasienId = Auth::id();

        // Cek apakah pasien sudah mendaftar di jadwal yang sama dan belum diperiksa
        $exists = DaftarPoli::where('id_pasien', $pasienId)
            ->where('id_jadwal', $request->id_jadwal)
            ->where('status_periksa', 0)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah terdaftar di jadwal pemeriksaan ini dan sedang menunggu antrean.');
        }

        // Tentukan nomor antrean berikutnya pada jadwal ini
        $lastAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->max('no_antrian') ?? 0;
        $nextAntrian = $lastAntrian + 1;

        DaftarPoli::create([
            'id_pasien'      => $pasienId,
            'id_jadwal'      => $request->id_jadwal,
            'keluhan'        => $request->keluhan,
            'no_antrian'     => $nextAntrian,
            'status_periksa' => 0,
        ]);

        return redirect()->route('pasien.dashboard')
            ->with('success', 'Pendaftaran pemeriksaan berhasil! Silakan cetak atau simpan tiket antrean Anda.');
    }
}
