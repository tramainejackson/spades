@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="container-fluid text-white py-3">
				<div class="row">
					<div class="col">
						<h1 class="text-light text-center">Edit Game</h1>
					</div>
				</div>
				<div class="row">
					<div class="col">
						{!! Form::model($game, ['action' => ['GameController@update', $game->id], 'method' => 'PATCH']) !!}
							<div class="card">
								<div class="card-header bg-dark">
									<h2 class="text-center">Game Result</h2>
								</div>
								<div class="card-body">
									<div class="container-fluid">
										<div class="row">
											<div class="col-6 py-4" style="border-right: solid 0.5px black;">
												<p class="text-center text-dark my-3">{{ $game->away_team }}</p>
												<div class="playerInfo d-flex flex-column justify-content-center align-items-center text-dark" style="font-size: 45% !important;">
													<span>{{ $game->away_team()->first()->player_1 }}</span>
													<span>&amp;</span>
													<span>{{ $game->away_team()->first()->player_2 }}</span>
												</div>
											</div>
											<div class="col-6 py-4" style="border-left: solid 0.5px black;">
												<p class="text-center text-dark my-3">{{ $game->home_team }}</p>
												<div class="playerInfo d-flex flex-column justify-content-center align-items-center text-dark" style="font-size: 45% !important;">
													<span>{{ $game->home_team()->first()->player_1 }}</span>
													<span>&amp;</span>
													<span>{{ $game->home_team()->first()->player_2 }}</span>
												</div>
											</div>
										</div>
										<div class="sm-divider"></div>
										<div class="row">
											<div class="col-6 pt-2 pb-4 d-flex justify-content-center align-items-center" style="border-right: solid 0.5px black;">
												<input type="number" name="away_team_score" class="awayTeamScore teamScore text-center w-50" id="" placeholder="Score" value="{{ $game->away_team_score }}" min="0" max="500" style="border: none; border-bottom: solid 1px; border-radius: 0px;" />
												<div class="d-flex flex-column align-items-center pl-2">
													<span class="text-dark" style="font-size: 40% !important;">Forfeit</span>
													<input type="checkbox" name="away_forfeit" class="forfeitBox" id="" value="Y" {{ $game->away_team_id == $game->losing_team_id && $game->forfeit == 'Y' ? 'checked' : '' }} />
												</div>
											</div>
											<div class="col-6 pt-2 pb-4 d-flex justify-content-center align-items-center" style="border-left: solid 0.5px black;">
												<input type="number" name="home_team_score" class="homeTeamScore teamScore text-center w-50" id="" placeholder="Score" value="{{ $game->home_team_score }}" min="0" max="500" style="border: none; border-bottom: solid 1px; border-radius: 0px;" />
												<div class="d-flex flex-column align-items-center pl-2">
													<span class="text-dark" style="font-size: 41% !important;">Forfeit</span>
													<input type="checkbox" name="home_forfeit" class="forfeitBox" id="" value="Y" {{ $game->home_team_id == $game->losing_team_id && $game->forfeit == 'Y' ? 'checked' : '' }} />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-center">
									@if($game->playin_game == 'N')
										<input type="text" name="round_id" class="" value="{{ $game->round }}" hidden />
									@endif
									{{ Form::submit('Update Game', ['class' => 'form-control btn btn-primary w-75']) }}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		<footer class="d-flex justify-content-center flex-column flex-md-row bg-dark text-white text-center py-3">
			<div class="d-flex flex-column mx-auto">
				<h2 class="">Contact Us</h2>
				<div class="">
					<span class="font-weight-bold pr-2">Email:</span>
					<a href="mailto:spades2spades@gmail.com" class="underline"><u>Spades King</u></a>
				</div>
				<div class="">
					<span class="font-weight-bold pr-2">Phone:</span>
					<span>215.999.9999</span>
				</div>
			</div>
			<div class="lg-divider d-md-none"></div>
			<div class="d-flex flex-column mx-auto">
				<p class="">10% of all proceeds will be donated to charity</p>
				<p class=""><span class="font-weight-bold">Organized By: </span>Montrell Duckett and Tramaine Jackson</p>
				<div class="">
					<div class="">
						<h5 class="mb-0">&reg;&nbsp;Registered by Tramaine</h5>
					</div>
				</div>
			</div>
		</footer>
		<script type="text/javascript">
			$('nav ul li:nth-of-type(2) a').addClass('active');			
		</script>
	@endsection