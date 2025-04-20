<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        return view('pasien.dashboard');
    }

    public function showPeriksa()
    {
        $showDokter = User::where('role', 'dokter')->get();
        $periksa = Periksa::with('dokter')
                    ->where('id_pasien', Auth::id())
                    ->latest()
                    ->get();

        return view('pasien.periksa', compact('showDokter', 'periksa'));
    }

    public function storePeriksa(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'tgl_periksa' => 'nullable|date',
            'catatan' => 'nullable|string|max:255',
            'biaya_periksa' => 'nullable|integer',
        ]);

        Periksa::create([
            'id_dokter' => $request->id_dokter,
            'id_pasien' => Auth::id(), // Supaya pasiennya pasti sesuai user login
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        return redirect()->route('periksaPasien')->with('success', 'Permintaan pemeriksaan berhasil dikirim.');
    }
}
