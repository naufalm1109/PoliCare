<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Tambah Jadwal Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi form di bawah ini untuk menambahkan jadwal pemeriksaan dokter sesuai dengan hari dan waktu yang tersedia.') }}
                            </p>
                        </header>

                        <form class="mt-6" id="formJadwal" action="{{ route('dokter.jadwal-periksa.store') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3 form-group">
                                <label for="hariSelect">Hari</label>
                                <select class="form-control" name="hari" id="hariSelect" required>
                                    <option value="">Pilih Hari</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                    <option>Minggu</option>
                                </select>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="jamMulai">Jam Mulai</label>
                                <input type="time" class="form-control" id="jamMulai" name="jam_mulai" required>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="jamSelesai">Jam Selesai</label>
                                <input type="time" class="form-control" id="jamSelesai" name="jam_selesai" required>
                            </div>
                            <a type="button" href="{{ route('dokter.jadwal-periksa.index') }}"
                                class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
