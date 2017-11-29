<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$settings = \App\Setting::where('id', 1)->first();
		$games = \App\Game::all();
		$teams = \App\Team::all();
		$teamsCount = \App\Team::all()->count();
		
		return view('games.index', compact('settings', 'games', 'teams', 'teamsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
		if(isset($request->round_id)) {
			$homeTeam = $request->home_team;
			$awayTeam = $request->away_team;
			$playoffRound = $request->round_id;
			$game->home_team_score = $request->home_team_score;
			$game->away_team_score = $request->away_team_score;
			$homeForfeit = isset($request->home_forfeit) ? $request->home_forfeit : "";
			$awayForfeit = isset($request->away_forfeit) ? $request->away_forfeit : "";
			$game->game_complete = ($game->home_team_score > 0 && $game->away_team_score > 0) || ($homeForfeit == 'Y' || $awayForfeit == 'Y') ? "Y" : "N";

			if($awayForfeit == 'Y') {
				$game->winning_team_id =  $game->home_team_id;
				$game->losing_team_id = $game->away_team_id;
				$game->home_team_score = $game->away_team_score = 0;
				$game->forfeit = $awayForfeit;
			} elseif($homeForfeit == 'Y') {
				$game->winning_team_id = $game->away_team_id;
				$game->losing_team_id = $game->home_team_id;
				$game->home_team_score = $game->away_team_score = 0;
				$game->forfeit = $homeForfeit;
			} else {
				if($game->home_team_score > 0 || $game->away_team_score > 0) {
					$game->winning_team_id = $game->home_team_score > $game->away_team_score ? $game->home_team_id : $game->away_team_id;
					$game->losing_team_id = $game->home_team_score > $game->away_team_score ? $game->away_team_id : $game->home_team_id;
					$game->forfeit = 'N';
				} elseif($game->home_team_score == 0 && $game->away_team_score == 0) {
					$game->winning_team_id = NULL;
					$game->losing_team_id = NULL;
					$game->forfeit = 'N';
					$game->game_complete = 'N';
				}
			}

			if($game->save()) {
				$game->complete_round($playoffRound);
			} else {
			}
		} else {
			$homeTeam = $request->home_team;
			$awayTeam = $request->away_team;
			$playoffRound = isset($request->round_id);
			$game->home_team_score = $request->home_team_score;
			$game->away_team_score = $request->away_team_score;
			$homeForfeit = isset($request->home_forfeit) ? $request->home_forfeit : "";
			$awayForfeit = isset($request->away_forfeit) ? $request->away_forfeit : "";
			$game->game_complete = ($game->home_team_score > 0 && $game->away_team_score > 0) || ($homeForfeit == 'Y' || $awayForfeit == 'Y') ? "Y" : "N";

			if($awayForfeit == 'Y') {
				$game->winning_team_id =  $game->home_team_id;
				$game->losing_team_id = $game->away_team_id;
				$game->home_team_score = $game->away_team_score = 0;
				$game->forfeit = $awayForfeit;
			} elseif($homeForfeit == 'Y') {
				$game->winning_team_id = $game->away_team_id;
				$game->losing_team_id = $game->home_team_id;
				$game->home_team_score = $game->away_team_score = 0;
				$game->forfeit = $homeForfeit;
			} else {
				if($game->home_team_score > 0 || $game->away_team_score > 0) {
					$game->winning_team_id = $game->home_team_score > $game->away_team_score ? $game->home_team_id : $game->away_team_id;
					$game->losing_team_id = $game->home_team_score > $game->away_team_score ? $game->away_team_id : $game->home_team_id;
					$game->forfeit = 'N';
				} elseif($game->home_team_score == 0 && $game->away_team_score == 0) {
					$game->winning_team_id = NULL;
					$game->losing_team_id = NULL;
					$game->forfeit = 'N';
					$game->game_complete = 'N';
				}
			}
			
			if($game->save()) {
				$game->complete_playins();
			} else {
			}
		}
		
		Log::info('Game Result: Team ID('.$game->home_team_id.') - '.$game->home_team_score.' vs Team ID('.$game->away_team_id.') - '.$game->away_team_score);
		
		return redirect()->action('GameController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
