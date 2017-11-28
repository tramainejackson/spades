@extends('layouts.app')
	@section('content')
		<div class="row h-100">
			<div class="col text-white">
				<div class="" style="">
					<h1 class="display-4 my-4 text-center">Settings</h1>
				</div>
			</div>
		</div>
		<div class="tournySettingsDiv bg-dark p-4 m-4 rounded" style="font-size:120%">
			{!! Form::model($setting, ['action' => ['SettingController@update', $setting->id], 'method' => 'PATCH']) !!}
				<div class="form-group">
					{{ Form::label('total_teams', 'Total Teams', ['class' => 'form-control-label text-white']) }}
					<input type="number" name="total_teams" class="form-control" value="{{ $teams->count() == null ? 0 : $teams->count() }}" disabled />
				</div>
				<div class="form-group">
					{{ Form::label('total_rounds', 'Total Rounds', ['class' => 'form-control-label text-white']) }}
					<input type="number" name="total_rounds" class="form-control" value="{{ $setting->total_rounds == null ? 0 : $setting->total_rounds }}" disabled />
				</div>
				<div class="form-group">
					{{ Form::label('teams_with_bye', 'Teams With bye', ['class' => 'form-control-label text-white']) }}
					<input type="number" name="total_teams" class="form-control" value="{{ $setting->teams_with_bye == null ? 0 : $setting->teams_with_bye }}" disabled />
				</div>
				<div class="form-group">
					{{ Form::label('playin_games', 'Playin Games', ['class' => 'form-control-label text-white']) }}
					<input type="text" name="playin_games" class="form-control" value="{{ $setting->playin_games }}" disabled />
				</div>
				<div class="form-group">
					{{ Form::label('champion', 'Champion', ['class' => 'form-control-label text-white']) }}
					<input type="text" name="" class="form-control" value="{{ $setting->champion == null ? 'No Champion Yet' : $setting->champion }}" disabled />
				</div>
				<div class="form-group">
					{{ Form::label('start_tourny', 'Start Tourney', ['class' => 'd-block form-control-label text-white']) }}
					
					<div class="btn-group">
						<button type="button" class="btn {{ $setting->start_tourny == 'Y' ? 'btn-success active' : '' }}">
							<input type="checkbox" name="start_tourny" value="Y" hidden {{ $setting->start_tourny == 'Y' ? 'checked' : '' }} />Yes
						</button>
						<button type="button" class="btn {{ $setting->start_tourny == 'N' ? 'btn-danger active' : '' }}">
							<input type="checkbox" name="start_tourny" value="N" hidden {{ $setting->start_tourny == 'N' ? 'checked' : '' }} />No
						</button>
					</div>
				</div>
				<div class="form-group">
					{{ Form::submit('Update', ['class' => 'form-control btn btn-primary mt-2']) }}
				</div>
			{!! Form::close() !!}
		</div>
	@endsection
	
	@section('footer')
		<footer class="d-flex flex-column justify-content-center bg-dark text-white text-center{{ $teams->isEmpty() ? ' fixed-bottom' : '' }}">
			<p class="">10% of all proceeds will be donated to charity</p>
			<p class="">Sponcered By: </p>
			<p class="">Organized By: </p>
			<div class="">
				<div class="">
					<h5 class="mb-0">&reg;&nbsp;Registered by Tramaine</h5>
				</div>
			</div>
		</footer>
		<script type="text/javascript">
			$('nav ul li:nth-of-type(3) a').addClass('active');			
		</script>
	@endsection