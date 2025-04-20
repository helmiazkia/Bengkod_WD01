<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'dokter') {
                
                return redirect()->route('dashboardDokter');
            } elseif (Auth::user()->role == 'pasien') {
               
                return redirect()->route('dashboardPasien');
            }else {
                return abort(403, 'Unauthorized action.');
            }
        }

        return redirect()->back()->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:30',
            'password' => 'required|min:8'
        ]);

        // Check if email already exists
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withInput();
        }

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pasien',
        ]);


        return redirect()->route('login');
    }

    public function logout()
    {
        $userName = Auth::user()->nama;
        Auth::logout();
        return redirect()->route('login');
    }
}