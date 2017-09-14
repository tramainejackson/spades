@extends('layouts.app')
	@section('content')
		<div class="row mt-3">
			<div class="col text-white">
				<div class="" style="">
					<h1 class="display-4 my-4 text-center">
						<a href="{{ route('teams.create') }}" class="btn btn-success float-right">Add Team</a>
					View Teams</h1>
				</div>
			</div>
		</div>
		@if($teams->isNotEmpty())
			<div class="row">
				@foreach ($teams as $team)
					<div class="col-4 text-white">
						<div class="card my-3 text-dark">
							<div class="card-header row">
								<h2 class="col-10 text-center d-inline-block">{{ $team->team_name }}</h2>
								<button class="col-2 btn btn-warning"><a href="/teams/{{$team->id}}/edit">Edit</a></button>
							</div>
							<div class="card-body">
								<h3 class="card-title">Player Names</h3>
								<p class="card-text">#1 - {{ $team->player_1 }}</p>
								<p class="card-text">#2 - {{ $team->player_2 }}</p>
							</div>
							<div class="card-footer text-center">
								<p class="">Paid In Full</p>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" {{ $team->pif == "Y" ? "checked" : "" }} disabled />Yes
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" {{ $team->pif == "N" ? "checked" : "" }} disabled />No
									</label>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row">
				<div class="col">
					<h2 class="">No teams have been added yet. Click <a href="{{ route('teams.create') }}" class="">here</a> to add your first team</h2>
				</div>
			</div>
		@endif
	@endsection
	
	@section('footer')
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$('nav ul li:nth-of-type(4) a').addClass('active');
		</script>
	@endsection