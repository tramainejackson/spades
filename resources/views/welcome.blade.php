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
					<h2 class="text-center pb-4 mb-3 mx-3" style="border-bottom:1px solid gray">Welcome</h2>
					<p class="">Welcome to the first annual spades tournament. This tournament is going to be the March Madness style, 64 team bracket. The first 64 teams to register will get a chance to reserve a spot to become the first true spade champion of Philly. Click <a href="{{ route('registration') }}">here</a> to register</p>
				</div>
			</div>
		
			<div class="py-5 px-3 text-white fullHeight">
				<h2 class="text-center pb-4 mb-3 mx-3">Registration</h2>
				<p class="">To register a team click <a href="{{ route('registration') }}">here</a>. The entry fee for every team will be $50. It is first come first serve and registration will close once we have reached 64 teams.</p>
				<p class=""></p>
			</div>
		</div>
	@endsection