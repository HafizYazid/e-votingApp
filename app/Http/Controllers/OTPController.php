<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailOTP;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\OTPMail;

class OTPController extends Controller
{
    public function requestOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $otp = rand(100000, 999999);
        $email = $request->email;

        // Ambil user yang sedang login
        $user = Auth::user();

        // Simpan email ke tabel user (kalau sebelumnya null)
        $user->email = $email;
        $user->save();

        // Simpan atau update OTP berdasarkan email, tapi ikat dengan id_user
        EmailOTP::updateOrCreate(
            ['email' => $email, 'id_user' => $user->id_user], // <= lebih spesifik
            [
                'otp' => $otp,
                'expired_at' => now()->addMinutes(2)
            ]
        );


        try {
            Mail::to($email)->send(new OTPMail($otp, $user->nama));
            return response()->json(['message' => 'OTP dikirim ke email.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengirim email.', 'error' => $e->getMessage()], 500);
        }
    }



    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);

        $user = Auth::user();

        $otpData = EmailOTP::where('email', $request->email)
            ->where('id_user', $user->id_user)
            ->first();

        if (
            !$otpData ||
            $otpData->otp !== $request->otp ||
            now()->gt($otpData->expired_at)
        ) {
            return response()->json(['message' => 'OTP salah atau sudah kedaluwarsa.'], 401);
        }

        $otpData->delete(); // OTP sudah diverifikasi

        return response()->json(['message' => 'OTP valid. Anda bisa melanjutkan voting.']);
    }
}