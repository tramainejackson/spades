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
			<div class="row text-white">
				<div class="col col-6">
					<p class="text-right">Total Teams:</p>
				</div>
				<div class="col col-6">
					<p class="">{{ $teams->count() }}</p>
				</div>
			</div>
			<div class="row text-white">
				<div class="col col-6">
					<p class="text-right">Total Rounds:</p>
				</div>
				<div class="col col-6">
					<p class="">{{ $setting->total_rounds == null ? "Tournament schedule not generated yet" : $setting->total_rounds }}</p>
				</div>
			</div>
			<div class="row text-white">
				<div class="col col-6">
					<p class="text-right">Champion:</p>
				</div>
				<div class="col col-6">
					<p class="">{{ $setting->champion == null ? "No Champion Yet" : $setting->champion }}</p>
				</div>
			</div>
			<div class="row text-white">
				<div class="col col-2">
					<button type="button" class="btn btn-warning"><a href="setting/{{ $setting->id }}/edit">Edit</a></button>
				</div>
				<div class="col col-4">
					<p class="text-right">Tourney Started:</p>
				</div>
				<div class="col col-6">
					<p class="">{{ $setting->start_tourny }}</p>
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		@include('footer')
		
		<script type="text/javascript">
			$('footer').addClass('fixed-bottom');
			$('nav ul li:nth-of-type(3) a').addClass('active');
		</script>
	@endsection