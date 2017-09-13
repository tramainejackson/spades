@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="container-fluid text-white py-3">
				<div class="row">
					<h2 class="w-100 text-center bg-dark">Edit Game</h2>
				</div>
				{!! Form::model($game, ['action' => ['GameController@update', $game->id], 'method' => 'PATCH']) !!}
					<div class="row">
						<h3 class="col-md-8">Away Team</h3>
						<h3 class="col-md-2">Score</h3>
						<h3 class="col-md-2">Forfeit</h3>
					</div>
					<div class="row">
						<div class="col-md-8">
							<input type="text" name="away_team" class="" value="{{ $game->away_team }}" disabled>
						</div>
						<div class="col-md-2">
							<input type="number" name="away_team_score" class="awayTeamScore teamScore" id="" placeholder="Score" value="{{ $game->away_team_score }}" min="0" max="500">
						</div>
						<div class="col-md-2">
							<input type="checkbox" name="away_forfeit" class="forfeitBox" id="" value="Y" {{ $game->away_team_id == $game->losing_team_id && $game->forfeit == 'Y' ? 'checked' : '' }}>
						</div>
					</div>
					<div class="row">
						<span class="col-md-8 vsSpan">vs</span>
					</div>
					<div class="row">
						<h3 class="col-md-8">Home Team</h3>
						<h3 class="col-md-2">Score</h3>
						<h3 class="col-md-2">Forfeit</h3>
					</div>
					<div class="row">
						<div class="col-md-8">
							<input type="text" name="home_team" class="" value="{{ $game->home_team }}" disabled>
						</div>
						<div class="col-md-2">
							<input type="number" name="home_team_score" class="homeTeamScore teamScore" id="" placeholder="Score" value="{{ $game->home_team_score }}" min="0" max="500">
						</div>
						<div class="col-md-2">
							<input type="checkbox" name="home_forfeit" class="forfeitBox" id="" value="Y" {{ $game->home_team_id == $game->losing_team_id && $game->forfeit == 'Y' ? 'checked' : '' }}>
						</div>
					</div>
					<div class="form-group">
						@if($game->playin_game == 'N')
							<input type="text" name="round_id" class="" value="{{ $game->round }}" hidden />
						@endif
						{{ Form::submit('Update', ['class' => 'form-control btn btn-primary my-3']) }}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		<script type="text/javascript">
			$('nav ul li:nth-of-type(4) a').addClass('active');			
		</script>
	@endsection