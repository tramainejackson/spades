@extends('layouts.app')
	@section('content')
		<div class="row flex-column align-items-center justify-content-center" style="position:relative">
			<div class="text-white my-4 display-4">
				<h1 class="">Registration</h1>
			</div>
			<div class="text-white px-3">
				<p class="">The entry fee for every team will be $50. It is first come first serve and registration will close once we have reached 64 teams. The tournament is single elimination</p>
			</div>
			<div class="fullHeight d-flex flex-column align-items-center justify-content-center m-3 px-3 regForm">
				<h2 class="text-white">Registration Form</h2>
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
						{{ Form::submit('Next', ['class' => 'form-control']) }}
					</div>
				{!! Form::close() !!}
				<p class="finePrint text-white">We will be accepting payments via Visa, Paypal, Cash App. Once the registration form is completed, you will be redirected to choose your choice of payment.</p>
			</div>
		</div>
	@endsection