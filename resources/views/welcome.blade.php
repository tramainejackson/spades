@extends('layouts.app')
	@section('content')
		<div class="row flex-column align-items-center justify-content-center welcomeHeader" style="position:relative">
			<div class="text-white my-5 fullHeight" style="">
				<h1 class="display-2 text-center mb-5" style="position:relative">Spades</h1>
				<h1 class="display-3 text-center text-truncate mb-5" style="position:relative">Tournament</h1>
				<h1 class="display-4 text-center pb-4 mb-5" style="position:relative">2018</h1>
			</div>
		
			<div class="">
				<div class="bg-white py-5 px-3 fullHeight">
					<h2 class="text-center pb-4 mb-3 mx-3 display-2" style="border-bottom:1px solid gray">Welcome</h2>
					<p class="px-sm-5">Welcome to the first annual spades tournament. This tournament is going to be the March Madness style, 64 team bracket. The first 64 teams to register will get a chance to reserve a spot to become the first true spade champion of Philly. Click <a href="{{ route('registration') }}">here</a> to register</p>
				</div>
			</div>
		
			<div class="py-5 px-3 text-white fullHeight">
				<h2 class="text-center pb-4 mb-3 mx-3 display-4">Registration</h2>
				<p class="px-sm-5">To register a team click <a href="{{ route('registration') }}">here</a>. The entry fee for every team will be $50. It is first come first serve and registration will close once we have reached 64 teams.</p>
				<p class=""></p>
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