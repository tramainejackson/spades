@extends('layouts.app')
	@section('content')
		<!-- Error Message -->
		<div class="" id="" onclick="move()">
			<h1 class="text-center p-3 rounded mt-5 bg-warning">This is not a functional page. You will be redirected in <span class="redirectTimer">10</span> seconds</h1>
		</div>
	@endsection
	
	@section('footer')
		
		@include('footer')
		<script>
			var countdown = 10;
			var timer = setInterval(frame, 1000);

			function frame() {
				if(countdown == 0) {
					clearInterval(timer);
					window.history.back()
				} else {
					countdown--;
					$('.redirectTimer').text(countdown);
				}
			}
			
			$('footer').addClass('fixed-bottom');
		</script>
	@endsection