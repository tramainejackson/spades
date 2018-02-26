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
			{!! Form::model($setting, ['action' => ['SettingController@update', $setting->id], 'method' => 'PATCH', 'files' => true]) !!}
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
					{{ Form::label('rules', 'Downloadable Rules', ['class' => 'form-control-label text-white']) }}
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="rules" class="custom-file-input" id="rulesFile" />
							{{ Form::label('rules', 'Upload Rules', ['class' => 'custom-file-label']) }}
						</div>
						<div class="input-group-append text-white">
							<span class="input-group-text">Browse</span>
						</div>
					</div>
				</div>
				@if($setting->printable_rules != null)
					<div class="form-group mt-4 d-flex align-items-center">
						<div class="d-inline-block mr-4 text-light">
							<h3 class="">Click To View Rules Document </h3>
						</div>
						<a href="{{ asset('storage/' . str_ireplace('public/', '', $setting->printable_rules)) }}" class="btn btn-light" download="2018_Spades_Tournament_Rules">View Rules</a>
					</div>
				@endif
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
			$('nav ul li:nth-of-type(3) a').addClass('active');			
		</script>
	@endsection