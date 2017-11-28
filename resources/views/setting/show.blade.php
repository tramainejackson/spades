@extends('layouts.app')
	@section('content')
		<div class="row h-100">
			<div class="col text-white">
				<div class="" style="">
					<h1 class="display-4 my-4 text-center">Rules</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col text-white py-3">
				<div class="">
					<h3 class="pb-3">The following rules will apply to every game:</h3>
					<ul class="" style="font-size:125%;">
						<li class="">All games go to 350 points</li>
						<li class="">No passing of spades (if you have 0 spades start praying)</li>
						<li class="">Minimum bid is 4 books</li>
						<li class="">Blinds bids start at a bid 6 books</li>
						<li class="">10 made books will result in 200 points</li>
						<li class="">Renege will cost your team 3 books</li>
						<li class="">Failure to bring your teams bid (set) twice in one game will result in the end of game.</li>
						<li class="">5 over books throught the entirity of the game will result in your team losing 50 points (does not count as a set)</li>
					</ul>
					<h5 class="p-3 text-center">Click <a href="#" class="">here</a> to download a printable version of the rule</h5>
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
			$('nav ul li:nth-of-type(4) a').addClass('active');			
		</script>
	@endsection