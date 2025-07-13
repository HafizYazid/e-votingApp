<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->getDashboardData();
        return view('dashboard', $data);
    }

    public function marasa()
    {
        $data = $this->getDashboardData();
        return view('marasa', $data); // pastikan ada file resources/views/marasa.blade.php
    }

    public function getVotingData()
    {
        $votingResults = DB::table('votes')
            ->join('candidate', 'votes.id_candidate', '=', 'candidate.id')
            ->select(
                'candidate.id',
                'candidate.nama_candidate',
                'candidate.nomor_urut',
                DB::raw('COUNT(votes.id_vote) as total_votes')
            )
            ->groupBy('candidate.id', 'candidate.nama_candidate', 'candidate.nomor_urut')
            ->orderBy('candidate.nomor_urut')
            ->get();

        $totalVotes = $votingResults->sum('total_votes');

        $votingResults = $votingResults->map(function ($result) use ($totalVotes) {
            $result->percentage = $totalVotes > 0 ? round(($result->total_votes / $totalVotes) * 100, 1) : 0;
            return $result;
        });

        return response()->json([
            'voting_results' => $votingResults,
            'total_votes' => $totalVotes,
            'participation_rate' => $this->calculateParticipationRate()
        ]);
    }

    private function getDashboardData()
    {
        $candidate = Candidate::all();

        $votingResults = DB::table('votes')
            ->join('candidate', 'votes.id_kandidat', '=', 'candidate.id_kandidat')
            ->select(
                'candidate.id_kandidat',
                'candidate.ketua',
                'candidate.wakil',
                DB::raw('COUNT(votes.id_vote) as total_votes')
            )
            ->groupBy('candidate.id_kandidat', 'candidate.ketua', 'candidate.wakil')
            ->orderBy('candidate.id_kandidat')
            ->get();

        $totalVotes = $votingResults->sum('total_votes');

        $votingResults = $votingResults->map(function ($result) use ($totalVotes) {
            $result->percentage = $totalVotes > 0 ? round(($result->total_votes / $totalVotes) * 100, 1) : 0;
            $result->nama_kandidat = $result->ketua . ' & ' . $result->wakil;
            return $result;
        });

        $stats = [
            'total_votes' => $totalVotes,
            'total_voters' => DB::table('users')->where('status', 1)->count(),
            'participation_rate' => $this->calculateParticipationRate(),
            'voting_period' => $this->getVotingPeriod(),
            'time_remaining' => $this->getTimeRemaining(),
            'target_participation' => 80
        ];

        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];

        return compact('candidate', 'votingResults', 'stats', 'colors');
    }

    private function calculateParticipationRate()
    {
        $totalVoters = DB::table('users')->where('status', 1)->count();
        $totalVoted = DB::table('votes')->distinct('id_user')->count('id_user');

        return $totalVoters > 0 ? round(($totalVoted / $totalVoters) * 100, 1) : 0;
    }

    private function getVotingPeriod()
    {
        return [
            'start_date' => '2025-07-17',
            'end_date' => '2025-07-19',
            'formatted' => '17-19 Juli 2025'
        ];
    }

    private function getTimeRemaining()
    {
        $end = Carbon::parse('2025-07-19 23:59:59');
        $now = now();

        if ($now->gt($end)) {
            return [
                'expired' => true,
                'formatted' => 'Voting Telah Berakhir',
                'end_timestamp' => $end->timestamp
            ];
        }

        $diff = $now->diff($end);
        return [
            'expired' => false,
            'days' => $diff->d,
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s,
            'formatted' => "{$diff->d} Hari {$diff->h} Jam {$diff->i} Menit {$diff->s} Detik",
            'end_timestamp' => $end->timestamp
        ];
    }
}
