@extends('layouts.app')
	@section('content')
		<div class="modal fade loadingSpinner">
			<div class="loader"></div>
			<div class="">
				<p class="text-white d-table mx-auto display-4">Registering....</p>
			</div>
		</div>
		<div class="row flex-column align-items-center justify-content-center" style="position:relative">
			<div class="text-white my-4 display-4">
				<h1 class="display-3 text-truncate">Registration</h1>
			</div>
			@php $settings = \App\Setting::where('id', 1)->first();	@endphp
			@if($settings->start_tourny == "N")
				<div class="text-white px-3">
					<p class="px-sm-5" style="font-size:125%;">The entry fee for every team will be $70. It is first come first serve and registration will close once we have reached 64 teams. The tournament is single elimination</p>
				</div>
				<div class="d-flex flex-column align-items-center justify-content-center m-3 px-3 pt-4 regForm">
					<div class="">
						<h2 class="text-white">Registration Form</h2>
						{!! Form::open(['action' => 'TeamController@store', 'class' => 'player_reg_form']) !!}
							<div class="form-group">
								{{ Form::label('email', 'Email Address', ['class' => 'form-control-label text-white']) }}
								{{ Form::email('email', '', ['class' => 'form-control', 'required']) }}
							</div>
							<div class="form-group">
								{{ Form::label('team_name', 'Team Name', ['class' => 'form-control-label text-white']) }}
								{{ Form::text('team_name', '', ['class' => 'form-control', 'required']) }}
							</div>
							<div class="form-group">
								{{ Form::label('player1', 'Player Name #1', ['class' => 'form-control-label text-white']) }}
								{{ Form::text('player1', '', ['class' => 'form-control', 'required']) }}
							</div>
							<div class="form-group">
								{{ Form::label('player2', 'Player Name #2', ['class' => 'form-control-label text-white']) }}
								{{ Form::text('player2', '', ['class' => 'form-control', 'required']) }}
							</div>
							<div class="form-group">
								{{ Form::submit('Next', ['class' => 'form-control btn btn-primary']) }}
							</div>
						{!! Form::close() !!}
						<p class="finePrint text-white mt-4">We will be accepting payments via Paypal or Cash App. Once the registration form is completed, you will be redirected to choose your choice of payment.</p>
					</div>
				</div>
			@else
				<div class="text-white px-3">
					<p class="px-sm-5" style="font-size:125%;">Registration is currently not available at this time. Either the tournament has started or the max number of teams have registered. Click <a href="{{ route('tournament') }}" class="">here</a> to check out the tournament in progress</p>
				</div>
			@endif
		</div>
	@endsection
	
	@section('footer')
		@include('footer')
		
		@if($settings->start_tourny == 'Y')
			<script type="text/javascript">
				$('footer').addClass('fixed-bottom');		
			</script>
		@endif
		
		<script type="text/javascript">
			$(".player_reg_form").submit(function(e){	
				$('.loadingSpinner').modal('show');
			});
			
			$('nav ul li:nth-of-type(2) a').addClass('active');			
		</script>
	@endsection