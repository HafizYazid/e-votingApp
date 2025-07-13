<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $candidates = Candidate::all();

        // Data statistik
        $totalUsers = User::count();
        $totalVoters = Vote::distinct('id_user')->count('id_user');
        $remainingVoters = $totalUsers - $totalVoters;
        $participation = $totalUsers > 0 ? round(($totalVoters / $totalUsers) * 100, 1) : 0;

        return view('voting', compact(
            'candidates',
            'totalUsers',
            'totalVoters',
            'remainingVoters',
            'participation'
        ));
    }

    public function submitVote(Request $request)
    {
        $request->validate([
            'id_kandidat' => 'required|exists:candidate,id_kandidat',
        ]);


        $user = Auth::user();

        // Cek apakah sudah pernah voting
        if ($user->status == 1) {
            return response()->json(['message' => 'Anda sudah melakukan voting sebelumnya.'], 403);
        }

        // Simpan vote
        Vote::create([
            'id_user' => $user->id_user,
            'id_kandidat' => $request->id_kandidat,
        ]);


        // Update status user
        $user->status = 1;
        $user->save();

        return response()->json(['message' => 'Voting berhasil. Terima kasih telah memilih!']);
    }

}
