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
        // Validasi hanya untuk id_dokter yang wajib diisi
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
        ]);

        // Membuat data pemeriksaan dengan nilai default untuk biaya_periksa dan tanggal periksa
        Periksa::create([
            'id_dokter' => $request->id_dokter,
            'id_pasien' => Auth::id(), // Pasiennya sesuai dengan yang login
            'tgl_periksa' => now(), // Tanggal periksa adalah tanggal sekarang + jam
            'catatan' => $request->catatan ?? null, // Jika tidak ada catatan, kosongkan
            'biaya_periksa' => $request->biaya_periksa ?? 0, // Jika tidak ada biaya, set 0
        ]);

        return redirect()->route('periksaPasien')->with('success', 'Permintaan pemeriksaan berhasil dikirim.');
    }
}
