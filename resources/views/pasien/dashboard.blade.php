<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in! Welcome ") }} {{ Auth::user()->name }}!
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Janji: Belum Periksa</h3>

                    @if($janjiPeriksas->isEmpty())
                        <p class="text-sm text-gray-600">Tidak ada janji periksa yang belum diperiksa.</p>
                    @else
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Poliklinik</th>
                                    <th class="border px-4 py-2">Dokter</th>
                                    <th class="border px-4 py-2">Hari</th>
                                    <th class="border px-4 py-2">Jam Mulai</th>
                                    <th class="border px-4 py-2">Jam Selesai</th>
                                    <th class="border px-4 py-2">Antrian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($janjiPeriksas as $index => $janji)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $janji->jadwalPeriksa->dokter->poli->nama ?? '-' }}</td>
                                        <td class="border px-4 py-2">{{ $janji->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                                        <td class="border px-4 py-2">{{ $janji->jadwalPeriksa->hari }}</td>
                                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_mulai)->format('H:i') }}</td>
                                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_selesai)->format('H:i') }}</td>
                                        <td class="border px-4 py-2">{{ $janji->no_antrian }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
