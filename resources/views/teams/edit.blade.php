@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="col text-white">
				<div class="" style="">
					<h1 class="display-4 my-4 text-center">Edit Teams</h1>
					<a href="{{ route('teams.create') }}" class="btn btn-success">Add Team</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-4 text-white">
				{!! Form::model($teams, ['action' => ['TeamController@update', $teams->id], 'method' => 'PATCH']) !!}
					<div class="form-group">
						{{ Form::label('email', 'Email Address', ['class' => 'form-control-label text-white']) }}
						{{ Form::email('email') }}
					</div>
					<div class="form-group">
						{{ Form::label('team_name', 'Team Name', ['class' => 'form-control-label text-white']) }}
						{{ Form::text('team_name') }}
					</div>
					<div class="form-group">
						{{ Form::label('player1', 'Player 1 Name', ['class' => 'form-control-label text-white']) }}
						{{ Form::text('player_1') }}
					</div>
					<div class="form-group">
						{{ Form::label('player2', 'Player 2 Name', ['class' => 'form-control-label text-white']) }}
						{{ Form::text('player_2') }}
					</div>
					<div class="form-group">
						{{ Form::label('pif', 'Paid in Full', ['class' => 'd-block form-control-label text-white']) }}
						
						<div class="btn-group">
							<button type="button" class="btn {{ $teams->pif == 'Y' ? 'btn-success active' : '' }}">
								<input type="checkbox" name="pif" value="Y" hidden {{ $teams->pif == 'Y' ? 'checked' : '' }} />Yes
							</button>
							<button type="button" class="btn {{ $teams->pif == 'N' ? 'btn-danger active' : '' }}">
								<input type="checkbox" name="pif" value="N" hidden {{ $teams->pif == 'N' ? 'checked' : '' }} />No
							</button>
						</div>
					</div>
					<div class="form-group">
						{{ Form::submit('Update', ['class' => 'form-control btn btn-primary']) }}
						<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_modal">Delete</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
		<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-dark">
						<div class="form-group">
							<label class="form-control-label">Email Address</label>
							<input type="email" class="" value="{{ $teams->email }}" disabled />
						</div>
						<div class="form-group">
							<label class="form-control-label">Team Name</label>
							<input type="text" class="" value="{{ $teams->team_name }}" disabled />
						</div>
						<div class="form-group">
							<label class="form-control-label">Player 1</label>
							<input type="text" class="" value="{{ $teams->player_1 }}" disabled />
						</div>
						<div class="form-group">
							<label for="team_name" class="form-control-label">Player 2</label>
							<input type="text" class="" value="{{ $teams->player_2 }}" disabled />
						</div>
						<div class="form-group">
							<label class="d-block form-control-label">Paid In Full</label>
							
							<div class="btn-group">
								<button type="button" class="btn {{ $teams->pif == 'Y' ? 'btn-success active' : '' }}" disabled >
									<input type="checkbox" name="pif" value="Y" hidden {{ $teams->pif == 'Y' ? 'checked' : '' }} />Yes
								</button>
								<button type="button" class="btn {{ $teams->pif == 'N' ? 'btn-danger active' : '' }}" disabled>
									<input type="checkbox" name="pif" value="N" hidden {{ $teams->pif == 'N' ? 'checked' : '' }} />No
								</button>
							</div>
						</div>
						{!! Form::model($teams, ['action' => ['TeamController@destroy', $teams->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
								<button class="btn btn-warning form-control " type="button">Cancel</button>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		<script type="text/javascript">
			$('nav ul li:nth-of-type(4) a').addClass('active');
			$('input').addClass('form-control');
		</script>
	@endsection