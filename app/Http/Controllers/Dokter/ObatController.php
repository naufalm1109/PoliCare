<?php

namespace App\Http\Controllers\Dokter;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat.index', compact('obats'));
    }

    public function indexDeleted()
    {
        $obats = Obat::onlyTrashed()->get();

        return view('dokter.obat.indexDeleted')->with([
            'obats' => $obats,
        ]);
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $request)
    {
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'Obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'Obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('status', 'Obat berhasil dihapus!');
    }

    public function restore($id)
    {
        // Cari data di "tempat sampah" (trashed) berdasarkan ID
        $obat = Obat::onlyTrashed()->findOrFail($id);

        // Jalankan method restore()
        $obat->restore();

        // Redirect kembali ke halaman daftar obat terhapus dengan pesan sukses
        return redirect()->route('dokter.obat.indexDeleted')->with('status', 'Obat berhasil dipulihkan!');
    }
}
