<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard');
    }

    public function showPeriksa()
    {
        return view('dokter.periksa');
    }

    public function showObat()
    {
        return view('dokter.obat');
    }
}