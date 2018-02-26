@extends('layouts.app')
	@section('content')
		<div class="row h-100">
			<div class="col my-4 text-white">
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
						<li class="">Championship game will be the best out of 3 games</li>
						<li class="">Each player can only play on one team. If eliminated, there will be no re-entry into the tournament</li>
						<li class="">All games go to 350 points</li>
						<li class="">No passing of cards (if you have 0 spades hope for the best)</li>
						<li class="">Minimum bid is 4 books</li>
						<li class="">10 made books will result in 200 points</li>
						<li class="">Blind bids start at a bid 6 books</li>
						<li class="">10 made books on the first hand will not end the game</li>
						<li class="">Renege will cost your team 3 books</li>
						<li class="">Failure to bring your teams bid (set) three times in one game will result in the end of game.</li>
						<li class="">5 over books throught the entirity of the game will result in your team losing 50 points (does not count as a set)</li>
						<li class="">There will be a list of rules at every table</li>
						<li class="">Spades Order (From Top - Bottom)
							<ul class="list-unstyled">
								<li class="media d-inline"><img src="/images/joker1.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/joker2.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/duece_diamond.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/duece_spade.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/ace.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/king.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/queen.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/jack.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/ten.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/nine.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/eight.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/seven.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/six.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/five.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/four.jpg" height="50" class="" /></li>
								<li class="media d-inline"><img src="/images/three.jpg" height="50" class="" /></li>
							</ul>
						</li>
					</ul>
					@if($setting->printable_rules != null)
						<h5 class="p-3 text-center">Click <a href="{{ asset('storage/' . str_ireplace('public/', '', $setting->printable_rules)) }}" class="">here</a> to download a printable version of the rule</h5>
					@else
						<h5 class="p-3 text-center">All rules will be available at each playing table</h5>
					@endif
				</div>
			</div>
		</div>
	@endsection
	
	@section('footer')
		
		@include('footer')
		
		<script type="text/javascript">
			$('nav ul li:nth-of-type(4) a').addClass('active');			
		</script>
	@endsection