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
		@include('footer')
		
		@if($teams->count() < 6 )
			<script type="text/javascript">
				$('footer').addClass('fixed-bottom');		
			</script>
		@endif
	@endsection