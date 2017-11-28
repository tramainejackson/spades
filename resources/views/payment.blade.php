@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="col p-2 mt-4 rounded teamRegPayment">
				<h2 class="text-center p-2 rounded-top">Registration Almost Complete</h2>
				<h3 class="text-justify p-3">Thanks for registering for the 2018 spades tournament. To ensure that your team has a spot in the tournament, select one of the options for payment below to complete the registration. This will ensure that your teams spot is reserved.</h3>
			</div>
		</div>
		<div class="row flex-column align-items-center justify-content-center mt-3" style="position:relative">
			<div class="p-5">
				<p class="text-justify text-white">Please select one of the options below, for anyone using Visa, MasterCard or Discover, there will be a $2.00 processing fee. Once payment is received, you will receive and email to <i>{{ $team->email }}</i> with time, location, and additional information.</p>
			</div>
			<div class="p-4 my-4">
				<a href="https://www.paypal.me/actionjack/50" class="">
					<div class="text-center" style="">
						<img src="/images/paypal_icon.png" class="img-fluid" style="max-height:250px;" />
					</div>
					<div class="">
						<p class="text-justify text-white">If you have a PayPal account and would like to complete payment through PayPal, please click here.</p>
					</div>
				</a>
			</div>
			<div class="p-4 my-4">
				<a href="https://cash.me/$tramainejack/50" class="">
					<div class="text-center" style="">
						<img src="/images/cash_icon.png" class="" style="max-height:250px;" />
					</div>
					<div class="">
						<p class="text-justify text-white">If you have a Cash App account and would like to complete payment through the Cash App, please click here.</p>
					</div>
				</a>
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
			$('nav ul li:nth-of-type(2) a').addClass('active');			
		</script>
	@endsection