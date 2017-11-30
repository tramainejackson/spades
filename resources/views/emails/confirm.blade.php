<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Spades Tournament</title>
	
	<style>
		@media (min-width: 1400px) {
            p, h3 {
                font-size: 150%;
            }
        }
	</style>
</head>
<body>
    <div id="app" class="container">
		<div style="position:relative; height:100%;">
			<div style="box-sizing: border-box; width: 100% !important;">
				<h2 class="" style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px; font-size: 200%; font-family: 'Playfair Display', serif;">Philly Spades Tournament</h2>
			</div>
			<div style="font-family: 'Playfair Display', serif;">
				<h3 style="margin: 0px 35px 35px;">Team Registration:</h3>
				<p style="padding: 0px 35px 15px;">Welcome to the first annual spades tournament. Your team has been registered as one of the 64. This tournament is going to be the March Madness style, 64 team bracket.</p>
				<p style="padding: 0px 35px 35px;">If your team has already paid, you should have received an email confirming it. If your team has not paid for the tournamet, you can click <a href="{{ route('payment', $team) }}">here</a> and select one of the options for payment. <span style="color: darkgray;">If your registration fee is not paid within one week of registration, your spot will be released and you will have to re-register.</span></p>
			</div>
			<footer style="box-sizing: border-box; width: 100% !important;">
				<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
			</footer>
		</div>
	</div>
</body>