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
						<div class="form-row">
							<div class="form-group col-6">
								{{ Form::label('pif', 'Paid in Full', ['class' => 'd-block form-control-label text-white']) }}
								
								<div class="btn-group">
									<button type="button" class="btn">
										<input type="checkbox" name="pif" value="Y" hidden />Yes
									</button>
									<button type="button" class="btn btn-danger">
										<input type="checkbox" name="pif" value="N" hidden checked />No
									</button>
								</div>
							</div>
							
							<div class="form-group col-6">
								{{ Form::label('admin_created', 'Fake Team', ['class' => 'd-block form-control-label text-white']) }}
								
								<div class="btn-group">
									<button type="button" class="btn">
										<input type="checkbox" name="admin_created" value="Y" hidden />Yes
									</button>
									<button type="button" class="btn btn-danger">
										<input type="checkbox" name="admin_created" value="N" hidden checked />No
									</button>
								</div>
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
		<footer class="d-flex justify-content-center bg-dark text-white text-center py-3">
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
			$('nav ul li:nth-of-type(1) a').addClass('active');

			// Dropdown menu toggle init
			$('.dropdown-toggle').dropdown();			
		</script>
	@endsection