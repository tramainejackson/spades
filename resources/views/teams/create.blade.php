@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="col text-white">
				<div class="" style="">
					<h1 class="display-4 my-4 text-center">Create New Team</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col text-white py-3">
				<div class="">
					{!! Form::open(['action' => 'TeamController@store']) !!}
						<div class="form-group">
							{{ Form::label('email', 'Email Address', ['class' => 'form-control-label text-white']) }}
							{{ Form::email('email', '', ['class' => 'form-control', 'required']) }}
						</div>
						<div class="form-group">
							{{ Form::label('team_name', 'Team Name', ['class' => 'form-control-label text-white']) }}
							{{ Form::text('team_name', '', ['class' => 'form-control', 'required']) }}
						</div>
						<div class="form-group">
							{{ Form::label('player1', 'Player 1 Name', ['class' => 'form-control-label text-white']) }}
							{{ Form::text('player1', '', ['class' => 'form-control', 'required']) }}
						</div>
						<div class="form-group">
							{{ Form::label('player2', 'Player 2 Name', ['class' => 'form-control-label text-white']) }}
							{{ Form::text('player2', '', ['class' => 'form-control', 'required']) }}
						</div>
						<div class="form-group">
							{{ Form::label('player2', 'Paid in Full', ['class' => 'd-block form-control-label text-white']) }}
							
							<div class="btn-group">
								<button type="button" class="btn">
									<input type="checkbox" name="pif" value="Y" hidden />Yes
								</button>
								<button type="button" class="btn btn-danger">
									<input type="checkbox" name="pif" value="N" hidden checked />No
								</button>
							</div>
						</div>

						<div class="form-group">
							{{ Form::submit('Add', ['class' => 'form-control btn btn-primary']) }}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		<script type="text/javascript">
			$('nav ul li:nth-of-type(4) a').addClass('active');

			// Dropdown menu toggle init
			$('.dropdown-toggle').dropdown();			
		</script>
	@endsection