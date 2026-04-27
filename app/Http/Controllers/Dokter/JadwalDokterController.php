<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalDokterController extends Controller
{
    /**
     * READ - Tampilkan semua jadwal milik dokter yang login
     */
    public function index()
    {
        $jadwals = JadwalDokter::where('user_id', Auth::id())
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->get();

        return view('dokter.jadwal.index', compact('jadwals'));
    }

    /**
     * CREATE - Form tambah jadwal
     */
    public function create()
    {
        return view('dokter.jadwal.create');
    }

    /**
     * STORE - Simpan jadwal baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota'       => 'required|integer|min:1|max:100',
            'status'      => 'required|in:aktif,nonaktif',
        ], [
            'hari.required'          => 'Hari wajib dipilih.',
            'jam_mulai.required'     => 'Jam mulai wajib diisi.',
            'jam_selesai.required'   => 'Jam selesai wajib diisi.',
            'jam_selesai.after'      => 'Jam selesai harus setelah jam mulai.',
            'kuota.required'         => 'Kuota wajib diisi.',
            'kuota.min'              => 'Kuota minimal 1.',
        ]);

        // Cek apakah jadwal hari tersebut sudah ada
        $exists = JadwalDokter::where('user_id', Auth::id())
            ->where('hari', $request->hari)
            ->exists();

        if ($exists) {
            return back()->withErrors(['hari' => 'Jadwal untuk hari ' . $request->hari . ' sudah ada.'])->withInput();
        }

        JadwalDokter::create([
            'user_id'     => Auth::id(),
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota'       => $request->kuota,
            'status'      => $request->status,
        ]);

        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * UPDATE - Form edit jadwal
     */
    public function edit(JadwalDokter $jadwal)
    {
        // Pastikan dokter hanya bisa edit jadwalnya sendiri
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    /**
     * UPDATE - Simpan perubahan jadwal
     */
    public function update(Request $request, JadwalDokter $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota'       => 'required|integer|min:1|max:100',
            'status'      => 'required|in:aktif,nonaktif',
        ], [
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'kuota.min'         => 'Kuota minimal 1.',
        ]);

        // Cek duplikat hari (kecuali record ini sendiri)
        $exists = JadwalDokter::where('user_id', Auth::id())
            ->where('hari', $request->hari)
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['hari' => 'Jadwal untuk hari ' . $request->hari . ' sudah ada.'])->withInput();
        }

        $jadwal->update([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota'       => $request->kuota,
            'status'      => $request->status,
        ]);

        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * DELETE - Hapus jadwal
     */
    public function destroy(JadwalDokter $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $jadwal->delete();

        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
