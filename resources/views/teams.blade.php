@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="col my-4 text-white">
				<h1 class="display-4 my-4 text-center">Tournament Ready</h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="teamCount container-fluid mb-5">
					<div class="row">
						<div class="col">
							<h2 class="text-light text-center">Registered Teams <span class="badge badge-primary">{{ $teams->count() }}</span></h2>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							@if($teams->count() < 64)
								<h2 class="text-light text-center">Open Slots 
									<span class="@if($teams->count() > 20) badge badge-danger
										@elseif($teams->count() > 40) badge badge-warning
										@else badge badge-success
										@endif">
										{{ 64 - $teams->count() }}
									</span>
								</h2>
							@endif
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<h2 class="text-light text-center p-3">Currently Registered Teams</h2>
						</div>
						
						@foreach($teams as $team)
							<div class="col-6 my-1 text-center">
								<button class="btn btn-light w-75 text-truncate" type="button">{{ $team->team_name }}</button>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		<footer class="d-flex justify-content-center flex-column flex-md-row bg-dark text-white text-center py-3{{ $teams->count() < 6 ? ' fixed-bottom' : '' }}">
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
	@endsection