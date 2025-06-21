<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat Terhapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Obat Terhapus') }}
                    </h2>

                    <div class="flex-col items-center justify-center text-center">
                        <a href="{{ route('dokter.obat.index') }}" class="btn btn-primary">Kembali</a>
                    </div>

                </header>
                @if (session('status'))
                    <div class="px-4 py-2 mt-4 text-green-800 bg-green-200 border border-green-300 rounded">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Kemasan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Waktu Dihapus</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($obats as $obat)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                <td class="align-middle text-start">
                                    {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ \Carbon\Carbon::parse($obat->deleted_at)->translatedFormat('d F Y H.i') }}</td>
                                <td class="px-4 py-2 align-middle text-start">
                                    {{-- TAMBAHKAN FORM UNTUK RESTORE --}}
                                    <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">
                                    Tidak ada obat yang terhapus.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
