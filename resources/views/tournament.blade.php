@extends('layouts.app')
	@section('content')
		<?php $getPlayInGames = Playoff_Schedule::get_playin_games($myLeague->get_league_id()); ?>
		<?php if($settings->is_play_in_games_complete() && $settings->is_play_in_games()) { ?>
			<?php $rounds = $settings->get_total_rounds(); ?>
			<?php $teams = $settings->get_playoff_teams(); ?>
			<?php $x = 1; ?>
			<div class="">
				<h2 class="">Playoff Schedule</h2>
			</div>
			<div class="playoffBracket">
				<div class="">
					<main id="tournament">
						<?php while($rounds > 0) { ?>
							<?php $games = ($teams/2); ?>
							<ul class="round round-<?php echo $x; ?>">
							
							<!--- Get games that are for round x from database --->
							<?php $playoffSchedule = Playoff_Schedule::get_round_games($myLeague->get_league_id(), $x); ?>
							<?php if(!empty($playoffSchedule)) { ?>
								<?php while(!empty($playoffSchedule)) { ?>
									<?php $roundGames = count($playoffSchedule); ?>
									<?php if($roundGames == ($teams/2)) { ?>
										<?php if($roundGames == 1) { ?>
											<?php $playoffs = $playoffSchedule; ?>
											<?php $playoffSchedule = array(); ?>

											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
										<?php } else { ?>
											<?php $playoffs = array_shift($playoffSchedule); ?>
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
										<?php } ?>
									<?php } elseif(fmod(count($playoffSchedule),2) == 0) { ?>
										<?php $findGameIndex = (count($playoffSchedule) / 2); ?>
										
										<?php if($findGameIndex == 1) { ?>
											<?php $playoffs = array_splice($playoffSchedule,$findGameIndex,1); ?>
											<?php $playoffs2 = array_splice($playoffSchedule,($findGameIndex-1),1); ?>

											<?php if($x > 1) { ?>
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->away_seed . ") " . $playoffs[0]->away_team; ?> <span><?php echo $playoffs[0]->away_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->home_seed . ") " . $playoffs[0]->home_team; ?> <span><?php echo $playoffs[0]->home_team_score; ?></span></li>
												
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->away_seed . ") " . $playoffs2[0]->away_team; ?> <span><?php echo $playoffs2[0]->away_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->home_seed . ") " . $playoffs2[0]->home_team; ?> <span><?php echo $playoffs2[0]->home_team_score; ?></span></li>
											<?php } else { ?>
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->home_seed . ") " . $playoffs[0]->home_team; ?> <span><?php echo $playoffs[0]->home_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->away_seed . ") " . $playoffs[0]->away_team; ?> <span><?php echo $playoffs[0]->away_team_score; ?></span></li>
												
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->home_seed . ") " . $playoffs2[0]->home_team; ?> <span><?php echo $playoffs2[0]->home_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->away_seed . ") " . $playoffs2[0]->away_team; ?> <span><?php echo $playoffs2[0]->away_team_score; ?></span></li>
											<?php } ?>
										<?php } else { ?>
											<?php $playoffs = array_splice($playoffSchedule,$findGameIndex,1); ?>
											<?php $playoffs2 = array_splice($playoffSchedule,($findGameIndex-1),1); ?>

											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->home_seed . ") " . $playoffs[0]->home_team; ?> <span><?php echo $playoffs[0]->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->away_seed . ") " . $playoffs[0]->away_team; ?> <span><?php echo $playoffs[0]->away_team_score; ?></span></li>
											
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->home_seed . ") " . $playoffs2[0]->home_team; ?> <span><?php echo $playoffs2[0]->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->away_seed . ") " . $playoffs2[0]->away_team; ?> <span><?php echo $playoffs2[0]->away_team_score; ?></span></li>
										<?php } ?>
									<?php } else { ?>
										<?php $playoffs = is_array($playoffSchedule) ? array_pop($playoffSchedule) : $playoffSchedule; ?>
										<?php $playoffSchedule = array(); ?>
										
										<?php if($x > 1) { ?>
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
										<?php } else { ?>
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<?php for($i=0; $i < $games; $i++) { ?>
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD<span></span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom ">TBD<span></span></li>
								<?php } ?>
							<?php } ?>
								<li class="spacer">&nbsp;</li>
							</ul>
							<?php $teams = ($teams/2); ?>
							<?php $rounds--; ?>
							<?php $x++; ?>
						<?php } ?>	
					</main>
				</div>
			</div>
			<?php if(is_array($getPlayInGames)) { ?>
				<div class='leagues_schedule'>
					<table id='' class='weekly_schedule'>
						<caption>Play-In Games</caption>
						<tr>
							<th>Time</th>
							<th>Match-Up</th>
							<th>Date</th>
						</tr>
						<?php foreach($getPlayInGames as $game) { ?>
							<tr>
								<td><?php echo $game->game_time == null ? "TBD" : $game->game_time; ?></td>
								<td><?php echo $game->away_team; ?> vs <?php echo $game->home_team; ?></td>
								<td><?php echo $game->game_date == null ? "TBD" : datetime_to_slash($game->game_date); ?></td>
								<?php if($game->game_complete == "Y") { ?>
									<?php if($game->forfeit == "Y") { ?>
										<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></td>
									<?php } else { ?>
										<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></td>
									<?php } ?>
								<?php } else { ?>
									<td>&nbsp;</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</table>	
				</div>
			<?php } elseif(is_object($getPlayInGames)) { ?>
				<?php $game = $getPlayInGames; ?>
				<div class='leagues_schedule'>
					<table id='' class='weekly_schedule'>
						<caption>Play-In Game</caption>
						<tr>
							<th>Time</th>
							<th>Match-Up</th>
							<th>Date</th>
						</tr>
						<tr>
							<td><?php echo $game->game_time == null ? "TBD" : $game->game_time; ?></td>
							<td><?php echo $game->away_team; ?> vs <?php echo $game->home_team; ?></td>
							<td><?php echo $game->game_date == null ? "TBD" : datetime_to_slash($game->game_date); ?></td>
							<?php if($game->game_complete == "Y") { ?>
								<?php if($game->forfeit == "Y") { ?>
									<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></td>
								<?php } else { ?>
									<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></td>
								<?php } ?>
							<?php } else { ?>
								<td>&nbsp;</td>
							<?php } ?>
						</tr>
					</table>	
				</div>
			<?php } ?>
		<?php } elseif(!$settings->is_play_in_games_complete() && $settings->is_play_in_games()) { ?>
			<div class="">
				<h2 class="">Playoff Schedule</h2>
			</div>
			<div class="playoffBracket">
				<div class="">
					<main id="tournament">
						<?php $rounds = 3; ?>
						<?php $teams = 8; ?>
						<?php $x = 1; ?>
						<?php while($rounds > 0) { ?>
							<?php $games = ($teams/2); ?>
							<ul class="round round-<?php echo $x; ?>">
								<?php for($i=0; $i < $games; $i++) { ?>
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD<span></span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom ">TBD<span></span></li>
								<?php } ?>
								<li class="spacer">&nbsp;</li>
							</ul>
							<?php $teams = ($teams/2); ?>
							<?php $rounds--; ?>
							<?php $x++; ?>
						<?php } ?>	
					</main>
				</div>
			</div>
			<?php if(is_array($getPlayInGames)) { ?>
				<div class='leagues_schedule'>
					<table id='' class='weekly_schedule'>
						<caption>Play-In Games</caption>
						<tr>
							<th>Time</th>
							<th>Match-Up</th>
							<th>Date</th>
						</tr>
						<?php foreach($getPlayInGames as $game) { ?>
							<tr>
								<td><?php echo $game->game_time == null ? "TBD" : $game->game_time; ?></td>
								<td><?php echo $game->away_team; ?> vs <?php echo $game->home_team; ?></td>
								<td><?php echo $game->game_date == null ? "TBD" : datetime_to_slash($game->game_date); ?></td>
								<?php if($game->game_complete == "Y") { ?>
									<?php if($game->forfeit == "Y") { ?>
										<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></td>
									<?php } else { ?>
										<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></td>
									<?php } ?>
								<?php } else { ?>
									<td>&nbsp;</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</table>	
				</div>
			<?php } elseif(is_object($getPlayInGames)) { ?>
				<?php $game = $getPlayInGames; ?>
				<div class='leagues_schedule'>
					<table id='' class='weekly_schedule'>
						<caption>Play-In Game</caption>
						<tr>
							<th>Time</th>
							<th>Match-Up</th>
							<th>Date</th>
						</tr>
						<tr>
							<td><?php echo $game->game_time == null ? "TBD" : $game->game_time; ?></td>
							<td><?php echo $game->away_team; ?> vs <?php echo $game->home_team; ?></td>
							<td><?php echo $game->game_date == null ? "TBD" : datetime_to_slash($game->game_date); ?></td>
							<?php if($game->game_complete == "Y") { ?>
								<?php if($game->forfeit == "Y") { ?>
									<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></td>
								<?php } else { ?>
									<td><?php echo $game->losing_team_id == $game->get_home_team_id() ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></td>
								<?php } ?>
							<?php } else { ?>
								<td>&nbsp;</td>
							<?php } ?>
						</tr>
					</table>
				</div>
			<?php } ?>
		<?php } else { ?>
			<?php $rounds = $settings->get_total_rounds(); ?>
			<?php $teams = $settings->get_playoff_teams(); ?>
			<?php $x = 1; ?>
			<div class="">
				<h2 class="">Playoff Schedule</h2>
			</div>
			<div class="playoffBracket">
				<div class="">
					<main id="tournament">
						<?php while($rounds > 0) { ?>
							<?php $games = ($teams/2); ?>
							<ul class="round round-<?php echo $x; ?>">
							
							<!--- Get games that are for round x from database --->
							<?php $playoffSchedule = Playoff_Schedule::get_round_games($myLeague->get_league_id(), $x); ?>
							<?php if(!empty($playoffSchedule)) { ?>
								<?php while(!empty($playoffSchedule)) { ?>
									<?php $roundGames = count($playoffSchedule); ?>
									<?php if($roundGames == ($teams/2)) { ?>
										<?php if($roundGames == 1) { ?>
											<?php $playoffs = $playoffSchedule; ?>
											<?php $playoffSchedule = array(); ?>

											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
										<?php } else { ?>
											<?php $playoffs = array_shift($playoffSchedule); ?>
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
										<?php } ?>
									<?php } elseif(fmod(count($playoffSchedule),2) == 0) { ?>
										<?php $findGameIndex = (count($playoffSchedule) / 2); ?>
										
										<?php if($findGameIndex == 1) { ?>
											<?php $playoffs = array_splice($playoffSchedule,$findGameIndex,1); ?>
											<?php $playoffs2 = array_splice($playoffSchedule,($findGameIndex-1),1); ?>

											<?php if($x > 1) { ?>
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->away_seed . ") " . $playoffs[0]->away_team; ?> <span><?php echo $playoffs[0]->away_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->home_seed . ") " . $playoffs[0]->home_team; ?> <span><?php echo $playoffs[0]->home_team_score; ?></span></li>
												
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->away_seed . ") " . $playoffs2[0]->away_team; ?> <span><?php echo $playoffs2[0]->away_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->home_seed . ") " . $playoffs2[0]->home_team; ?> <span><?php echo $playoffs2[0]->home_team_score; ?></span></li>
											<?php } else { ?>
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->home_seed . ") " . $playoffs[0]->home_team; ?> <span><?php echo $playoffs[0]->home_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->away_seed . ") " . $playoffs[0]->away_team; ?> <span><?php echo $playoffs[0]->away_team_score; ?></span></li>
												
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->home_seed . ") " . $playoffs2[0]->home_team; ?> <span><?php echo $playoffs2[0]->home_team_score; ?></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->away_seed . ") " . $playoffs2[0]->away_team; ?> <span><?php echo $playoffs2[0]->away_team_score; ?></span></li>
											<?php } ?>
										<?php } else { ?>
											<?php $playoffs = array_splice($playoffSchedule,$findGameIndex,1); ?>
											<?php $playoffs2 = array_splice($playoffSchedule,($findGameIndex-1),1); ?>

											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->home_seed . ") " . $playoffs[0]->home_team; ?> <span><?php echo $playoffs[0]->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs[0]->winning_team_id == $playoffs[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs[0]->away_seed . ") " . $playoffs[0]->away_team; ?> <span><?php echo $playoffs[0]->away_team_score; ?></span></li>
											
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->home_seed . ") " . $playoffs2[0]->home_team; ?> <span><?php echo $playoffs2[0]->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs2[0]->winning_team_id == $playoffs2[0]->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs2[0]->away_seed . ") " . $playoffs2[0]->away_team; ?> <span><?php echo $playoffs2[0]->away_team_score; ?></span></li>
										<?php } ?>
									<?php } else { ?>
										<?php $playoffs = is_array($playoffSchedule) ? array_pop($playoffSchedule) : $playoffSchedule; ?>
										
										<?php if($x > 1) { ?>
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
										<?php } else { ?>
											<li class="spacer">&nbsp;</li>
											
											<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->get_home_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
											<li class="game game-spacer">&nbsp;</li>
											<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->get_away_team_id() ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<?php for($i=0; $i < $games; $i++) { ?>
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD<span></span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom ">TBD<span></span></li>
								<?php } ?>
							<?php } ?>
								<li class="spacer">&nbsp;</li>
							</ul>
							<?php $teams = ($teams/2); ?>
							<?php $rounds--; ?>
							<?php $x++; ?>
						<?php } ?>	
					</main>
				</div>
			</div>
		<?php } ?>
	@endsection