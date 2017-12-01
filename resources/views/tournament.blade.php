@extends('layouts.app')
	@section('content')
		@php
			$settings = \App\Setting::find(1);
			$games = \App\Game::all();
			$teams = \App\Team::all();
		@endphp
		<div class="view_schedule">
			<div class="row">
				<div class="col text-white">
					<h1 class="display-4 my-4 text-center">Tourney Bracketology</h1>
				</div>
			</div>
			@if($settings->start_tourny == "Y")
				@if($settings->champion != null)
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
				
				@if($settings->playin_games == 'N')
					@php $x = 1; @endphp
					@php $rounds = $settings->total_rounds; @endphp
					@php $teams = $teams->count() - $settings->teams_with_bye; @endphp

					@if($rounds > 0)
						<div class="row playoffBracket text-white">
							<div class="col">
								<main id="tournament">
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
															<li class="game game-bottom{{ $playoffs->winning_team_id == $playoffs->away_team_id ? ' winner' : '' }}">{{ $playoffs->away_seed . ") " . $playoffs->away_team }} <span>{{ $playoffs->away_team_score }}</span></li>
														<?php } else { ?>
															<?php $playoffs = $playoffSchedule->shift(); ?>
															<li class="spacer">&nbsp;</li>
															
															<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
															<li class="game game-spacer">&nbsp;</li>
															<li class="game game-bottom{{ $playoffs->winning_team_id == $playoffs->away_team_id ? ' winner' : '' }}">{{ $playoffs->away_seed . ") " . $playoffs->away_team }} <span>{{ $playoffs->away_team_score }}</span></li>
														<?php } ?>
													@elseif(fmod(count($playoffSchedule),2) == 0)
														<?php $findGameIndex = (count($playoffSchedule) / 2); ?>
														
														<?php if($findGameIndex == 1) { ?>
															<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
															<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

															<?php if($x > 1) { ?>
																<li class="spacer">&nbsp;</li>											
																<li class="game game-top{{ $playoffs->winning_team_id == $playoffs->away_team_id ? ' winner' : '' }}">{{ $playoffs->away_seed . ") " . $playoffs->away_team }} <span>{{ $playoffs->away_team_score }}</span></li>
																<li class="game game-spacer">&nbsp;</li>
														<li class="game game-bottom{{ $playoffs->winning_team_id == $playoffs->home_team_id ? ' winner' : '' }}">{{ $playoffs->home_seed . ") " . $playoffs->home_team }} <span>{{ $playoffs->home_team_score }}</span></li>
																
																<li class="spacer">&nbsp;</li>
																
																<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
																<li class="game game-spacer">&nbsp;</li>
																<li class="game game-bottom{{ $playoffs2->winning_team_id == $playoffs2->home_team_id ? ' winner' : '' }}">{{ $playoffs2->home_seed . ") " . $playoffs2->home_team }} <span>{{ $playoffs2->home_team_score }}</span></li>
															<?php } else { ?>
																<li class="spacer">&nbsp;</li>
																
																<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
																<li class="game game-spacer">&nbsp;</li>
																<li class="game game-bottom{{ $playoffs->winning_team_id == $playoffs->away_team_id ? ' winner' : '' }}">{{ $playoffs->away_seed . ") " . $playoffs->away_team }} <span>{{ $playoffs->away_team_score }}</span></li>
																
																<li class="spacer">&nbsp;</li>
																
																<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
																<li class="game game-spacer">&nbsp;</li>
																<li class="game game-bottom{{ $playoffs2->winning_team_id == $playoffs2->away_team_id ? ' winner' : '' }}">{{ $playoffs2->away_seed . ") " . $playoffs2->away_team }} <span>{{ $playoffs2->away_team_score }}</span></li>
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
													<li class="game game-bottom">TBD<span></span></li>
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
					@else
						<div class="row">
							<div class="col">
								<h3 class="text-center text-light">The tournament has not be generated yet</h3>
							</div>
						</div>
						<div class="row">
							<div class="col">
								@include('bracketology')
							</div>
						</div>
					@endif
					
				@elseif($settings->playin_games_complete == 'Y' && $settings->playin_games == 'Y')
					@php $getPlayInGames = \App\Game::where('playin_game', 'Y')->get(); @endphp
					@php $nonPlayInGames = \App\Game::where('playin_game', 'N')->orderBy('round', 'desc')->get(); @endphp
					@php $x = 1; @endphp
					@php $rounds = $settings->total_rounds; @endphp
					@php $teams = $teams->count() - $settings->teams_with_bye; @endphp
					
					@if(fmod($teams, 2) != 0)
						@php $teams = 32; @endphp
						@php $rounds = 5; @endphp
					@endif
					
					@if($nonPlayInGames->isNotEmpty())
						@for($i=$rounds; $i >= 0; $i--)
							@php $roundGames = \App\Game::where('round', $i)->get(); @endphp	
							@if($roundGames->isNotEmpty())
								<div class="row">
									<div class="col ">
										@if($i != $rounds)
											<h2 class="roundHeader text-center p-3 my-3">Round {{ $i }} Games</h2>
										@else
											<h2 class="roundHeader text-center p-3 my-3">Championship Game</h2>
										@endif
									</div>
								</div>
								<div class="row">
									@foreach($roundGames as $game)
										<div class="col col-4 my-3">
											<div class="card">
												<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
													<h2 class="text-center">Round {{ $game->round }} Game</h2>
												</div>
												<div class="card-body">
													<p class="text-center">{{ $game->away_team}} vs {{ $game->home_team}}</p>
													
													@if($game->game_complete == "Y")
														@if($game->forfeit == "Y")
															<p class="text-center"><?php echo $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></p>
														@else
															<p class="text-center"><?php echo $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></p>
														@endif
													@endif
												</div>
											</div>
										</div>
									@endforeach	
								</div>
							@endif
						@endfor
					@endif
					
					@if($getPlayInGames->isNotEmpty())
						<div class="row">
							<div class="col col-12">
								<h2 class="roundHeader text-center p-3 my-3">Play In Games</h2>
							</div>
							@foreach($getPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">Play In Game</h2>
										</div>
										<div class="card-body">
											<p class="text-center">{{ $game->away_team}} vs {{ $game->home_team}}</p>
											
											@if($game->game_complete == "Y")
												<?php if($game->forfeit == "Y") { ?>
													<p class="text-center"><?php echo $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit"; ?></p>
												<?php } else { ?>
													<p class="text-center"><?php echo $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score; ?></p>
												<?php } ?>
											@endif
										</div>
									</div>
								</div>
							@endforeach	
						</div>
					@endif

					<div class="row playoffBracket text-white">
						<div class="col">
							<main id="tournament">
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
															<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
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
												<li class="game game-bottom">TBD<span></span></li>
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
				@elseif($settings->playin_games_complete == 'N' && $settings->playin_games == 'Y')
					@php $getPlayInGames = \App\Game::where('playin_game', 'Y')->get(); @endphp
					@if($getPlayInGames->isNotEmpty())
						<div class="divClass">
							<div class="col">
								<p class="text-center text-warning">*Once playin games complete, tournament bracket will be posted</p>
							</div>
						</div>
						<div class="row">
							<div class="col col-12">
								<h2 class="roundHeader text-center p-3 my-3">Play In Games</h2>
							</div>
							
							@foreach($getPlayInGames as $game)
								<div class="col col-4 my-3">
									<div class="card">
										<div class="card-header {{ $game->game_complete == 'Y' ? 'bg-success text-white' : 'bg-danger text-white'}}">
											<h2 class="text-center">Play In Game</h2>
										</div>
										<div class="card-body">
											<p class="text-center">{{ $game->away_team}} vs {{ $game->home_team}}</p>
											
											@if($game->game_complete == "Y")
												@if($game->forfeit == "Y")
													<p class="text-center">{{ $game->losing_team_id == $game->home_team_id ? $game->home_team . " loss due to forfeit" : $game->away_team . " loss due to forfeit" }}</p>
												@else
													<p class="text-center">{{ $game->losing_team_id == $game->home_team_id ? $game->away_team . " with the win over " . $game->home_team . " " . $game->away_team_score . " - " . $game->home_team_score : $game->home_team . " beat " . $game->away_team . " " . $game->home_team_score . " - " . $game->away_team_score }}</p>
												@endif
											@endif
										</div>
									</div>
								</div>
							@endforeach	
						</div>
					@endif
					<div class="row playoffBracket">
						<div class="col">
							@include('bracketology')
						</div>
					</div>
				@endif
			@else
				<div class="row">
					<div class="col">
						<h3 class="text-white">The tournament schedule will be posted on (Add Date) once registration has closed and bracket has been completed. If there is an odd number of teams, there will be playin games for the teams who register last.</h3>
					</div>
				</div>
				<div class="row d-none d-md-block">
					<div class="col">
						<div class="teamCount container-fluid">
							<div class="row">
								<div class="col">
									<h2 class="text-light">Registered Teams Count <span class="badge badge-primary">{{ $teamCount->count() }}</span></h2>
								</div>
							</div>
							
							<div class="row">
								<div class="col">
									@if($teamCount->count() < 64)
										<h2 class="text-light">Remaining Open Slots 
											<span class="@if($teamCount->count() > 20) badge badge-danger
												@elseif($teamCount->count() > 40) badge badge-warning
												@else badge badge-success
												@endif">
												{{ 64 - $teamCount->count() }}
											</span>
										</h2>
									@endif
								</div>
							</div>
							
							<div class="row">
								<div class="col-12">
									<h2 class="text-light text-center py-sm-3">Currently Registered Teams</h2>
								</div>
								
								@foreach($teamCount as $team)
									<div class="col-3 my-1 text-center">
										<button class="btn btn-light w-75 text-truncate" type="button">{{ $team->team_name }}</button>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="row playoffBracket">
					<div class="col">
						@include('bracketology')
					</div>
				</div>
			@endif
			<div class="row">
				<div class="col">
					<p class="text-white">*Single game elimination for every round.</p>
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		
		@include('footer')
		
		<script type="text/javascript">
			$('nav ul li:nth-of-type(3) a').addClass('active');			
		</script>
	@endsection