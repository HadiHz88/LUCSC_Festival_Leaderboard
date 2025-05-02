<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('points', 'desc')
                    ->orderBy('games_played', 'desc')
                    ->get();

        return view('leaderboard.index', compact('teams'));
    }

    public function addMatch(Request $request, Team $team)
    {
        $request->validate([
            'won' => 'required|boolean',
            'points' => 'required|integer|min:0'
        ]);

        $team->games_played += 1;
        if ($request->won) {
            $team->wins += 1;
        }
        $team->points += $request->points;
        $team->save();

        return response()->json([
            'success' => true,
            'team' => $team->fresh()
        ]);
    }
}