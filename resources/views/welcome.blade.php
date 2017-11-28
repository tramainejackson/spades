@extends('layouts.app')
	@section('content')
		<div class="row flex-column align-items-center justify-content-center welcomeHeader" style="position:relative">
			<div class="text-white my-5 fullHeight" style="">
				<h1 class="text-center">Philly</h1>
				<h1 class="text-center">Spades</h1>
				<h1 class="text-center text-truncate">Tournament</h1>
				<h1 class="text-center">2018</h1>
			</div>
		
			<div class="">
				<div class="bg-white py-5 px-3 fullHeight">
					<h2 class="text-center pb-4 mb-3 mx-3 display-2" style="border-bottom:1px solid gray">Welcome</h2>
					<p class="px-sm-5">Welcome to the first annual spades tournament. This tournament is going to be the March Madness style, 64 team bracket. The first 64 teams to register will get a chance to reserve a spot to become the first true spade champion of Philly. Click <a href="{{ route('registration') }}">here</a> to register</p>
					<p class="px-sm-5">Of course everybody plays the game a little differently depending on where you are from so we have a narrowed down the rules to most common way of playing. Check out the list of rules <a href="/rules" class="">here.</a> Rules will be attached to every table for each game</p>
					<p class="px-sm-5">There will be a cash prize for the winner (a check will be given to the winning team). If all 64 slots are satisfied, the prize will be $1,000.</p>
					<p class="px-sm-5">There will also be a light buffet and non-alcoholic available. The event will be BYOB.</p>
				</div>
			</div>
		
			<div class="py-5 px-3 text-white fullHeight">
				<h2 class="text-center pb-4 mb-3 mx-3 display-4">Registration</h2>
				<p class="px-sm-5">To register a team click <a href="{{ route('registration') }}">here</a>. The entry fee for every team will be $50. It is first come first serve and registration will close once we have reached 64 teams. There is a no refund policy so please make sure that you provide a correct email address for notification of time and place of tournament.</p>
				<p class="px-sm-5">If you have any questions or concerns, please feel free to email us any time at <a href="mailto:spades2spades@gmail" class="">spades2spades@gmail.</a></p>
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
			$('nav ul li:first-of-type a').addClass('active');			
		</script>
	@endsection