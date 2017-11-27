<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function create_tourney_settings()
	{

		// dd($standings);

		$checkSettings = $this;
		$totalPlayoffTeams = \App\Team::all();
		$checkSchedule = \App\Game::all();
		$teams = $this->total_teams = \App\Team::all()->count();
		$target = 0;
		$round = 1;
		$rounds = 1;
		$homeSeed = 0;
		$awaySeed = $teams + 1;

		if($teams > 3) {
			// Create playoff settings
			do {
				$target = pow($teams, 1/$rounds);
				
				if($target <= 2) {
					if($target != 2) {
						$target = 0;
						$remainingTeams = 0;
						do {
							$teams--;
							$remainingTeams++;
							$target = pow($teams, 1/($rounds-1));
							if($target == 2) {
								if(fmod($remainingTeams, 2) != 0) {
									if($remainingTeams == 1) {
									} else {
									}
								}
							} while($target != 2);
							$rounds--;
						} else {
							break;
						}
					} else {
						$rounds++;			
					}
				} while($target != 2);

				$this->total_rounds = $rounds;
				$this->teams_with_bye = 0;
				$this->playin_games = "N";
				$this->playin_games_complete = "Y";

				if(isset($remainingTeams)) {
					$this->teams_with_bye = ($teams - $remainingTeams);
					$this->total_tourney_teams = $teams;
					$this->playin_games = "Y";
					$this->playin_games_complete = "N";
				}

				// Create playoff schedule
				if($this->playin_games == "Y") {
					$totalByeTeams = $this->teams_with_bye;
					$playInSeeds = $totalPlayoffTeams->count();
					$removeByeTeams = $totalPlayoffTeams->splice(0, $totalByeTeams);
					$totalPlayInGames = $totalPlayoffTeams->count() / 2;
					
					for($x=0; $x < $totalPlayInGames; $x++) {
						$playoffSchedule = new \App\Game();
						$playInSeeds--;
						$homeSeed = $awaySeed = $playInSeeds;
						$homeTeam = $totalPlayoffTeams->shift();
						$awayTeam = $totalPlayoffTeams->pop();
						$playoffSchedule->home_team = $homeTeam->team_name;
						$playoffSchedule->home_team_id = $homeTeam->id;
						$playoffSchedule->away_team = $awayTeam->team_name;
						$playoffSchedule->away_team_id = $awayTeam->id;
						$playoffSchedule->home_seed = $homeSeed;
						$playoffSchedule->away_seed = $awaySeed;
						// $playoffSchedule->game_time = "12:00";
						// $playoffSchedule->game_date = date("Y-m-d");
						$playoffSchedule->playin_game = "Y";

						if($playoffSchedule->save()) {
							// $playoffSchedule->set_game_id($database->insert_id());
							// $playoffSchedule->id = $database->insert_id();
							
							// if($playoffSchedule->save()) {
								// // Add players from both teams to the stats table
								// $newStats = new League_Stats();
								// if($newStats->add_new_stats($playoffSchedule->get_league_id(), $playoffSchedule->get_game_id(), $playoffSchedule->get_home_team_id(), $playoffSchedule->get_away_team_id(), "NULL", "Y")) {
									// // $message->success("<li>All players have been added for stat keeping</li>");
								// } else {
									// // $message->error("<li>Players not added for stat keeping</li>");
								// }
							// }
						}
					}
				} else {
					// dd($totalPlayoffTeams);
					while($totalPlayoffTeams->isNotEmpty()) {
						$playoffSchedule = new \App\Game();
						$homeSeed++;
						$awaySeed--;
						$homeTeam = $totalPlayoffTeams->shift();
						$awayTeam = $totalPlayoffTeams->pop();
						
						$playoffSchedule->home_team = $homeTeam->team_name;
						$playoffSchedule->home_team_id = $homeTeam->id;
						$playoffSchedule->away_team = $awayTeam->team_name;
						$playoffSchedule->away_team_id = $awayTeam->id;
						$playoffSchedule->home_seed = $homeSeed;
						$playoffSchedule->away_seed = $awaySeed;
						$playoffSchedule->playin_game = "N";
						$playoffSchedule->round = $round;

						if($playoffSchedule->save()) {
							// $playoffSchedule->set_game_id($database->insert_id());
							// $playoffSchedule->id = $database->insert_id();
							
							// if($playoffSchedule->save()) {
								// // Add players from both teams to the stats table
								// $newStats = new League_Stats();
								// if($newStats->add_new_stats($playoffSchedule->get_league_id(), $playoffSchedule->get_game_id(), $playoffSchedule->get_home_team_id(), $playoffSchedule->get_away_team_id(), $round, "Y")) {
									// // $message->success("<li>All players have been added for stat keeping</li>");
								// } else {
									// // $message->error("<li>Players not added for stat keeping</li>");
								// }
							// }
						}
					}
				}
			} else {
				$this->total_rounds = NULL;
				$this->teams_with_bye = NULL;
				$this->playin_games = "N";
				$this->playin_games_complete = "Y";
				$this->champion = NULL;
				$this->champion_id = NULL;
			}
		}
	}
	
	public function remove_active_games() {
		DB::table('games')->truncate();
	}
}
