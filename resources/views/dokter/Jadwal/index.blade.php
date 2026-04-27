<x-layouts.app title="Jadwal Periksa">

    <div class="p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Jadwal Periksa</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola jadwal praktik Anda</p>
            </div>
            <a href="{{ route('dokter.jadwal.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus w-4"></i>
                Tambah Jadwal
            </a>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-5 py-3">No</th>
                            <th class="px-5 py-3">Hari</th>
                            <th class="px-5 py-3">Jam Mulai</th>
                            <th class="px-5 py-3">Jam Selesai</th>
                            <th class="px-5 py-3">Kuota</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse($jadwals as $index => $jadwal)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-4">{{ $index + 1 }}</td>
                            <td class="px-5 py-4 font-medium">{{ $jadwal->hari }}</td>
                            <td class="px-5 py-4">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</td>
                            <td class="px-5 py-4">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                            <td class="px-5 py-4">{{ $jadwal->kuota }} pasien</td>
                            <td class="px-5 py-4">
                                @if($jadwal->status === 'aktif')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('dokter.jadwal.edit', $jadwal->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-yellow-50 text-yellow-700 hover:bg-yellow-100 text-xs font-medium transition">
                                        <i class="fas fa-pen w-3"></i> Edit
                                    </a>
                                    <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus jadwal hari {{ $jadwal->hari }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium transition">
                                            <i class="fas fa-trash w-3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-gray-400">
                                <i class="fas fa-calendar-xmark text-4xl mb-3 block text-gray-300"></i>
                                <p class="text-sm font-medium">Belum ada jadwal</p>
                                <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Jadwal" untuk memulai.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-layouts.app>
