<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Spades Tournament</title>
</head>
<body>
    <div id="app" class="container">
		<div style="position:relative; height:100%;">
			<div style="box-sizing: border-box;">
				<h2 class="" style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">Philly Spades Tournament</h2>
			</div>
			<div class="">
				<h3 style="margin: 35px;">Team Registration:</h3>
				<p style="padding: 35px;">Welcome to the first annual spades tournament. This tournament is going to be the March Madness style, 64 team bracket. Your team has been registered as one of the 64.</p>
				<p class="">If your team has already paid, you should have received an email confirming it. If your team has not paid for the tournamet, you can click <a href="/payment/">here</a> and select one of the options for payments</p>
			</div>
			<footer style="box-sizing: border-box;">
				<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
			</footer>
		</div>
	</div>
</body>