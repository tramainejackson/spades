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
			$('nav ul li:nth-of-type(3) a').addClass('active');			
		</script>
	@endsection