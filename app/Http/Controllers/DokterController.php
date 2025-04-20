<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard');
    }

    public function showPeriksa()
    {
        $obats = Obat::latest()->get();
        $periksa = Periksa::with('pasien')
                    ->where('id_dokter', Auth::id())
                    ->latest()
                    ->get();
        return view('dokter.periksa', compact('periksa', 'obats'));
    }

    public function editPeriksa($id)
    {
        $periksa = Periksa::with('pasien')->findOrFail($id);

        if ($periksa->id_dokter !== Auth::id()) {
            abort(403);
        }

        return view('dokter.periksaEdit', compact('periksa'));
    }

    public function updatePeriksa(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'required|integer',
        ]);

        $periksa = Periksa::findOrFail($id);
        if ($periksa->id_dokter !== Auth::id()) {
            abort(403);
        }

        $periksa->update([
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        return redirect()->route('periksaDokter')->with('success', 'Data periksa berhasil diperbarui.');
    }

    public function showObat()
    {
        $obats = Obat::latest()->get();
        return view('dokter.obat', compact('obats'));
    }

    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:69',
            'harga' => 'required|integer',
        ]);

        Obat::create($request->all());
        return redirect()->route('obatDokter');
    }

    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:69',
            'harga' => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());
        return redirect()->route('obatDokter');
    }

    public function deleteObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obatDokter');
    }
}
