<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

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
		$settings = \App\Setting::findOrfail(1);
		$games = \App\Game::all();
		$teams = \App\Team::all();
		
		return view('games.index', compact('settings', 'games', 'teams'));
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
			// $playoffSetting = League_Settings::get_league_settings($league->get_league_id());
			// $game = Playoff_Schedule::get_game_by_id($_POST['game_id'], $league->get_league_id());
			$homeTeam = $request->home_team;
			$awayTeam = $request->away_team;
			$playoffRound = $request->round_id;
			// $game->game_date = $_POST['game_date'];
			// $game->game_time = $_POST['game_time'];
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
				// $message->success("<li>Game results have been updated</li>");
				$game->complete_round($playoffRound);
			} else {
				// $message->error("<li>Game results did not update</li>");
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
				// $message->success("<li>Game results have been updated</li>");
				
				// if($playoffCheck->is_playoffs()) {
					// $playoffRound == "" || $playoffRound < 1 ? $game->complete_playins() : $game->complete_round($playoffRound);
				// } else {
					// // Update standings
					// if($updateStandings = League_Standings::update_standings()) {
						// $message->success("<li>Standings have been updated</li>");
					// } else {
						// $message->error("<li>Standings did not update</li>");
					// }
				// }
			} else {
				// $message->error("<li>Game results did not update</li>");
			}
		}
		
		// dd($request->all());
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
