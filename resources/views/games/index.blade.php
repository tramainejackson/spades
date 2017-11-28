@extends('layouts.app')
	@section('content')
		<div class="view_schedule">
			<div class="row">
				<div class="col text-white">
					<h1 class="display-4 my-4 text-center">Tourney Schedule</h1>
				</div>
			</div>
			@if($settings->start_tourny == "Y")
				@if($settings->champion_id != null)
					@php $champTeam = \App\Team::where('id', $settings->champion_id)->first(); @endphp
					<div class="col col-12 p-5 text-center champDiv">
						<div class="">
							<h3 class="display-2">Champions</h3>
						</div>
						<div class="">
							<h4 class="display-3">{{ $champTeam->team_name }}</h4>
						</div>
						<div class="">
							<p class="">{{ $champTeam->player_1 }}</p>
							<p class="">{{ $champTeam->player_2 }}</p>
						</div>
					</div>
				@endif
				@if($settings->playin_games_complete == 'Y' && $settings->playin_games == 'N')
					@php $nonPlayInGames = \App\Game::where('playin_game', 'N')->orderBy('round', 'desc')->get(); @endphp
					@php $x = 1; @endphp
					@php $rounds = $settings->total_rounds; @endphp
					@php $teams = $settings->total_teams; @endphp
					
					@if($nonPlayInGames->isNotEmpty())
						<div class="row">
							@foreach($nonPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">
											<a href="games/{{ $game->id }}/edit" class="btn btn-warning float-right">Edit</a>
											Round {{ $game->round }} Game</h2>
										</div>
										<?php if($game->game_complete == "Y") { ?>
											<?php if($game->forfeit == "Y") { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></p>
											<?php } else { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></p>
											<?php } ?>
										<?php } else { ?>
											<p class="text-center pt-3">{{ $game->away_team}} vs {{ $game->home_team}}</p>
										<?php } ?>
									</div>
								</div>
							@endforeach	
						</div>
					@endif

					<div class="row playoffBracket">
						<div class="col">
							<main id="tournament" class="text-white">
								@while($rounds > 0)
									@php $totalGames = ($teams/2); @endphp
									<ul class="round round-{{ $x }}">
										<!--- Get games that are for round x from database --->
										@php $playoffSchedule = \App\Game::where('round', $x)->get(); @endphp
										@if($playoffSchedule->isNotEmpty())
											@while($playoffSchedule->isNotEmpty())
												@php $roundGames = count($playoffSchedule); @endphp
												@if($roundGames == ($teams/2))
													<?php if($roundGames == 1) { ?>
														<?php $playoffs = $playoffSchedule; ?>
														<?php $playoffSchedule = array(); ?>

														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
													<?php } else { ?>
														<?php $playoffs = $playoffSchedule->shift(); ?>
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
													<?php } ?>
												@elseif(fmod(count($playoffSchedule),2) == 0)
													<?php $findGameIndex = (count($playoffSchedule) / 2); ?>
													
													<?php if($findGameIndex == 1) { ?>
														<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
														<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

														<?php if($x > 1) { ?>
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
															
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
														<?php } else { ?>
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
															
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->way_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
														<?php } ?>
													<?php } else { ?>
														<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
														<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
														
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
													<?php } ?>
												@else
													<?php $playoffs = $playoffSchedule->pop(); ?>
												
													<?php if($x > 1) { ?>
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
													<?php } else { ?>
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
													<?php } ?>
												@endif
											@endwhile
										@else
											@for($i=0; $i < $totalGames; $i++)
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top">TBD<span></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom ">TBD<span></span></li>
											@endfor
										@endif
										<li class="spacer">&nbsp;</li>
									</ul>
									
									@php $teams = ($teams/2); @endphp
									@php $rounds--; @endphp
									@php $x++; @endphp
								@endwhile
							</main>
						</div>
					</div>
				@elseif($settings->playin_games_complete == 'Y' && $settings->playin_games == 'Y')
					@php $getPlayInGames = \App\Game::where('playin_game', 'Y')->get(); @endphp
					@php $nonPlayInGames = \App\Game::where('playin_game', 'N')->orderBy('round', 'desc')->get(); @endphp
					@php $x = 1; @endphp
					@php $rounds = $settings->total_rounds; @endphp
					@php $teams = $settings->total_tourney_teams; @endphp
					
					@if(fmod($teams, 2) != 0)
						@php $teams = 32; @endphp
						@php $rounds = 5; @endphp
					@endif
					
					@if($nonPlayInGames->isNotEmpty())
						<div class="row">
							@foreach($nonPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">
											<a href="games/{{ $game->id }}/edit" class="btn btn-warning float-right">Edit</a>
											Round {{ $game->round }} Game</h2>
										</div>
										<?php if($game->game_complete == "Y") { ?>
											<?php if($game->forfeit == "Y") { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></p>
											<?php } else { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></p>
											<?php } ?>
										<?php } else { ?>
											<p class="text-center pt-3">{{ $game->away_team}} vs {{ $game->home_team}}</p>
										<?php } ?>
									</div>
								</div>
							@endforeach	
						</div>
					@endif
					
					@if($getPlayInGames->isNotEmpty())
						<div class="row">
							<div class="col col-12">
								<h3 class="text-white">Play In Games</h3>
							</div>
							@foreach($getPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">
											<a href="games/{{ $game->id }}/edit" class="btn btn-warning float-right">Edit</a>
											Play In Game</h2>
										</div>
										<?php if($game->game_complete == "Y") { ?>
											<?php if($game->forfeit == "Y") { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></p>
											<?php } else { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></p>
											<?php } ?>
										<?php } else { ?>
											<p class="text-center pt-3">{{ $game->away_team}} vs {{ $game->home_team}}</p>
										<?php } ?>
									</div>
								</div>
							@endforeach	
						</div>
					@endif
					<div class="row playoffBracket text-white">
						<div class="col">
							<main id="tournament" class="text-white">
								@while($rounds > 0)
									@php $totalGames = ($teams/2); @endphp
									<ul class="round round-{{ $x }}">
										<!--- Get games that are for round x from database --->
										@php $playoffSchedule = \App\Game::where('round', $x)->get(); @endphp
										@if($playoffSchedule->isNotEmpty())
											@while($playoffSchedule->isNotEmpty())
												@php $roundGames = $playoffSchedule->count(); @endphp
												@if($roundGames == ($teams/2))
													<?php if($roundGames == 1) { ?>
														<?php $playoffs = $playoffSchedule->shift(); ?>

														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
													<?php } else { ?>
														<?php $playoffs = $playoffSchedule->shift(); ?>
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
													<?php } ?>
												@elseif(fmod(count($playoffSchedule),2) == 0)
													<?php $findGameIndex = (count($playoffSchedule) / 2); ?>
													
													<?php if($findGameIndex == 1) { ?>
														<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
														<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

														<?php if($x > 1) { ?>
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
															
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
														<?php } else { ?>
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
															
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->way_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
														<?php } ?>
													<?php } else { ?>
														<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
														<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
														
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
													<?php } ?>
												@else
													<?php $playoffs = $playoffSchedule->pop(); ?>
												
													<?php if($x > 1) { ?>
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
													<?php } else { ?>
														<li class="spacer">&nbsp;</li>
														
														<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
														<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
													<?php } ?>
												@endif
											@endwhile
										@else
											@for($i=0; $i < $totalGames; $i++)
												<li class="spacer">&nbsp;</li>
												
												<li class="game game-top">TBD<span></span></li>
												<li class="game game-spacer">&nbsp;</li>
												<li class="game game-bottom ">TBD<span></span></li>
											@endfor
										@endif
										<li class="spacer">&nbsp;</li>
									</ul>
									
									@php $teams = ($teams/2); @endphp
									@php $rounds--; @endphp
									@php $x++; @endphp
								@endwhile
							</main>
						</div>
					</div>
				@elseif($settings->playin_games_complete == 'N' && $settings->playin_games == 'N')
					<div class="row text-white">
						<div class="col" style="position:relative">
							<p class="">Tournament bracket will be displayed once all teams have registered.</p>
						</div>
						<div class="col">
							<p class="">Current Teams:&nbsp;<span>{{ $teams->count() }}</span></p>
							<p class="">Available Teams Remaining:&nbsp;<span>{{ (64 - $teams->count()) }}</span></p>
						</div>
					</div>
				@else
					@php $nonPlayInGames = \App\Game::where('playin_game', 'N')->orderBy('round', 'desc')->get(); @endphp
					@php $getPlayInGames = \App\Game::where('playin_game', 'Y')->get(); @endphp

					@if($getPlayInGames->isNotEmpty())
						<div class="row">
							<div class="col col-12">
								<h3 class="text-white">Play In Games</h3>
							</div>
							@foreach($getPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">
											<a href="games/{{ $game->id }}/edit" class="btn btn-warning float-right">Edit</a>
											Play In Game</h2>
										</div>
										
										@if($game->game_complete == "Y")
											@if($game->forfeit == "Y")
												<p class="text-center pt-3">{{ $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit" }}</p>
											@else
												<p class="text-center pt-3">{{ $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score }}</p>
											@endif
										@else
											<p class="text-center pt-3">{{ $game->away_team}} vs {{ $game->home_team}}</p>
										@endif
									</div>
								</div>
							@endforeach	
						</div>
					@endif
					
					@if($nonPlayInGames->isNotEmpty())
						<div class="row">
							@foreach($nonPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">
											<a href="games/{{ $game->id }}/edit" class="btn btn-warning float-right">Edit</a>
											Round {{ $game->round }} Game</h2>
										</div>
										<?php if($game->game_complete == "Y") { ?>
											<?php if($game->forfeit == "Y") { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></p>
											<?php } else { ?>
												<p class="text-center pt-3"><?php echo $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></p>
											<?php } ?>
										<?php } else { ?>
											<p class="text-center pt-3">{{ $game->away_team}} vs {{ $game->home_team}}</p>
										<?php } ?>
									</div>
								</div>
							@endforeach	
						</div>
					@endif

					<div class="row playoffBracket">
						<div class="col">
							<main id="tournament" class="text-white" style="position:relative">
								<ul class="round round-1">
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
								</ul>
								<ul class="round round-2">
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top ">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
								</ul>
								<ul class="round round-3">
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom">TBD <span>0</span></li>

									<li class="spacer">&nbsp;</li>
								</ul>
								<ul class="round round-4">
									<li class="spacer">&nbsp;</li>
									
									<li class="game game-top">TBD <span>0</span></li>
									<li class="game game-spacer">&nbsp;</li>
									<li class="game game-bottom ">TBD <span>0</span></li>
									
									<li class="spacer">&nbsp;</li>
								</ul>		
							</main>
						</div>
					</div>
				@endif
				@if($games->count() < 2)
					<div class="row">
						<div class="col">
							<h2 class="text-white m-4">You do not have enough teams to create a tournament.</h2>
						</div>
					</div>
				@endif
			@else
				<div class="row">
					<div class="col">
						<h2 class="text-white">You have not started your tournament yet. Click <a class="navLink" href="/setting">here</a> to go to settings to start the tournament</h2>
					</div>
				</div>
			@endif
		</div>
	@endsection
	
	@section('footer')
		<footer class="d-flex flex-column justify-content-center bg-dark text-white text-center{{ $settings->total_rounds == NULL ||  $settings->total_rounds < 2 || $settings->start_tourny == 'N' ? ' fixed-bottom' : '' }}">
			<p class="">10% of all proceeds will be donated to charity</p>
			<p class="">Sponcered By: </p>
			<p class="">Organized By: Montrell Duckett and Tramaine Jackson</p>
			<div class="">
				<div class="">
					<h5 class="mb-0">&reg;&nbsp;Registered by Tramaine</h5>
				</div>
			</div>
		</footer>
		<script type="text/javascript">
			$('nav ul li:nth-of-type(2) a').addClass('active');			
		</script>
	@endsection