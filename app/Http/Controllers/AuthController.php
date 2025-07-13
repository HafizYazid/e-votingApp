<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('nim', $request->nim)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'NIM tidak ditemukan.'
            ]);
        }

        if ($request->password !== $user->password) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah.'
            ]);
        }

        Auth::login($user); // GANTI dari Session::put ke Laravel Auth

        return response()->json([
            'success' => true,
            'redirect' => route('dashboard')
        ]);
    }

    public function logout()
    {
        Auth::logout(); // GANTI dari Session::forget
        return redirect()->route('dashboard')->with('success', 'Anda telah berhasil logout.');
    }
}
