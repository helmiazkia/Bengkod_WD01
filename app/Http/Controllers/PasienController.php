<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        return view('pasien.dashboard');
    }

    public function showPeriksa()
    {
        return view('pasien.periksa');
    }

    public function showRiwayat()
    {
        return view('pasien.riwayat');
    }
}