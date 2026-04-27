<x-layouts.app title="Edit Jadwal Periksa">

    <div class="p-6 max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('dokter.jadwal.index') }}"
                class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition">
                <i class="fas fa-arrow-left w-4"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal</h1>
                <p class="text-sm text-gray-500">Perbarui jadwal praktik Anda</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('dokter.jadwal.update', $jadwal->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Hari --}}
                <div>
                    <label for="hari" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Hari <span class="text-red-500">*</span>
                    </label>
                    <select id="hari" name="hari"
                        class="w-full border {{ $errors->has('hari') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                            <option value="{{ $hari }}"
                                {{ old('hari', $jadwal->hari) === $hari ? 'selected' : '' }}>
                                {{ $hari }}
                            </option>
                        @endforeach
                    </select>
                    @error('hari')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jam Mulai & Jam Selesai --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Jam Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="jam_mulai" name="jam_mulai"
                            value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}"
                            class="w-full border {{ $errors->has('jam_mulai') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('jam_mulai')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Jam Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="jam_selesai" name="jam_selesai"
                            value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}"
                            class="w-full border {{ $errors->has('jam_selesai') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('jam_selesai')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kuota --}}
                <div>
                    <label for="kuota" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kuota Pasien <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="kuota" name="kuota"
                        value="{{ old('kuota', $jadwal->kuota) }}" min="1" max="100"
                        class="w-full border {{ $errors->has('kuota') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('kuota')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="aktif"
                                {{ old('status', $jadwal->status) === 'aktif' ? 'checked' : '' }}
                                class="text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="nonaktif"
                                {{ old('status', $jadwal->status) === 'nonaktif' ? 'checked' : '' }}
                                class="text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Nonaktif</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2.5 rounded-lg transition">
                        Perbarui Jadwal
                    </button>
                    <a href="{{ route('dokter.jadwal.index') }}"
                        class="flex-1 text-center border border-gray-300 text-gray-600 hover:bg-gray-50 text-sm font-medium py-2.5 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

</x-layouts.app>
