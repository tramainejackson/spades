@extends('layouts.app')
	@section('content')
		<div class="row">
			<div class="col p-2 mt-4 rounded teamRegPayment">
				<h2 class="text-center p-2 rounded-top">Registration Almost Complete</h2>
				<h3 class="text-justify p-3">Thanks for registering for the 2018 spades tournament. To ensure that your team has a spot in the tournament, select one of the options for payment below to complete the registration. This will ensure that your teams spot is reserved.</h3>
			</div>
		</div>
		<div class="row flex-column align-items-center justify-content-center mt-3" style="position:relative">
			<div class="p-4 my-4">
				<a href="https://paypal.me/pools/c/82fi87eAal" class="">
					<div class="text-center" style="">
						<img src="/images/paypal_icon.png" class="img-fluid" style="max-height:250px;" />
					</div>
					<div class="payAppDesc">
						<p class="text-justify text-white">If you have a PayPal account and would like to complete payment through PayPal, please click here.</p>
					</div>
				</a>
			</div>
			<div class="p-4 my-4">
				<a href="https://cash.me/$spadesking/70" class="">
					<div class="text-center" style="">
						<img src="/images/cash_icon.png" class="" style="max-height:250px;" />
					</div>
					<div class="payAppDesc">
						<p class="text-justify text-white">If you have a Cash App account and would like to complete payment through the Cash App, please click here.</p>
					</div>
				</a>
			</div>
		</div>
	@endsection
	
	@section('footer')
		@include('footer')
		
		<script type="text/javascript">
			$('nav ul li:nth-of-type(2) a').addClass('active');			
		</script>
	@endsection