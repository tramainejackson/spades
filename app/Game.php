<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function complete_round($round=0) {
		$games = \App\Game::where('round', $round)->get();
		$completeGames = 0;
		$newRound = ($round + 1);

		if($games->isNotEmpty()) {
			if($games->isNotEmpty()) {
				foreach($games as $game) {
					if($game->game_complete == "Y") {
						$completeGames++;
					}
				}
			} else {
				$completeGames = 0;
			}
			
			if($games->count() == $completeGames) {
				$settings = \App\Setting::findOrFail(1);
				
				if($newRound <= $settings->total_rounds) {
					
					// Check to see if there is already a new round of games
					// Update the new round of games with the correct winning teams
					$nextRound = \App\Game::where('round', $newRound)->get();
					if($nextRound->isNotEmpty()) {
						$newRound->delete();
					}
					for($x=0; $x < $games->count(); $x+2) {
						$playoffSchedule = new \App\Game;
						$homeTeam = $games->shift();
						$awayTeam = $games->pop();
						
						$playoffSchedule->home_team = $homeTeam->winning_team_id == $homeTeam->home_team_id ? $homeTeam->home_team : $homeTeam->away_team;
						$playoffSchedule->home_team_id = $homeTeam->winning_team_id;
						$playoffSchedule->away_team = $awayTeam->winning_team_id == $awayTeam->home_team_id ? $awayTeam->home_team : $awayTeam->away_team;
						$playoffSchedule->away_team_id = $awayTeam->winning_team_id;
						$playoffSchedule->round = $newRound;
						$playoffSchedule->home_seed = $homeTeam->winning_team_id == $homeTeam->home_team_id ? $homeTeam->home_seed : $homeTeam->away_seed;
						$playoffSchedule->away_seed = $awayTeam->winning_team_id == $awayTeam->home_team_id ? $awayTeam->home_seed : $awayTeam->away_seed;

						if($playoffSchedule->save()) {}
					}
				} else {
					$settings->champion = $game->winning_team_id == $game->home_team_id ? $game->home_team : $game->away_team;
					$settings->champion_id = $game->winning_team_id;
					
					if($settings->save()) {}
				}
			}
		}
	}
	
	public function complete_playins() {
		$games = \App\Game::where('playin_game', 'Y')->get();
		$roundGames = \App\Game::where('playin_game', 'N')->get();
		$completeGames = 0;
		$newRound = 1;

		if($roundGames->isEmpty()) {
			if($games->isNotEmpty()) {
				if($games->isNotEmpty()) {
					foreach($games as $game) {
						if($game->game_complete == "Y") {
							$completeGames++;
						}
					}
				} else {
					$completeGames = 0;
				}
				
				if($games->count() == $completeGames) {
					$settings = \App\Setting::findOrFail(1);
					$standings = \App\Team::all();
					$playoffTeams = collect();
					
					// Get the teams who have a bye
					// Add them to the array of playoff teams
					$totalByeTeams = $settings->teams_with_bye;
					
					for($x=1; $x <= $totalByeTeams; $x++) {
						$byeTeam = $standings->shift();
						$playoffTeams->push($byeTeam);
					}
					
					// Get the teams that have won their bye game
					// Add them to the array of playoff teams
					if($games->isNotEmpty()) {
						foreach($games as $game) {
							$team = \App\Team::findOrFail($game->winning_team_id);
							$playoffTeams->push($team);
						}
					}
					
					$homeSeed = 1;
					$awaySeed = $playoffTeams->count();
					// $settings->set_playoff_teams(count($playoffTeams));

					if(\App\Game::where('round', 1)->get()->isNotEmpty()) {
						\App\Game::where('round', 1)->delete();
					}
					
					for($x=0; $x < $playoffTeams->count(); $x+2) {
						$playoffSchedule = new \App\Game;
						$homeTeam = $playoffTeams->shift();
						$awayTeam = $playoffTeams->pop();

						$playoffSchedule->home_team = $homeTeam->team_name;
						$playoffSchedule->home_team_id = $homeTeam->id;
						$playoffSchedule->away_team = $awayTeam->team_name;
						$playoffSchedule->away_team_id = $awayTeam->id;
						$playoffSchedule->round = $newRound;
						$playoffSchedule->home_seed = $homeSeed;
						$playoffSchedule->away_seed = $awaySeed;
						// $playoffSchedule->game_time = "12:00";
						// $playoffSchedule->game_date = date("Y-m-d");

						if($playoffSchedule->save()) {}
						
						$homeSeed++;
						$awaySeed--;
					}

					$settings->playin_games_complete = "Y";
					if($settings->save()){}
				}
			}
		}
	}
}
