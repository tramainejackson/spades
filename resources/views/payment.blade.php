@extends('layouts.app')
	@section('content')
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