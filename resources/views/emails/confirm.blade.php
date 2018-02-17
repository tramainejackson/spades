<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Spades Tournament</title>
	<style>
		div {
			font-family: Arial, Helvetica, sans-serif;
		}

		a:not(.flyer) {
			color: black;
			text-decoration: underline;
		}

		a.flyer.btn {
			color: #28a745;
			background-image: none;
			background-color: transparent;
			display: inline-block;
			font-weight: normal;
			text-align: center;
			text-decoration: none;
			border: 1px solid transparent;
			border-color: #28a745;
			padding: 0.5rem 0.75rem;
			font-size: 1rem;
			line-height: 1.25;
			border-radius: 0.25rem;
			white-space: initial;
			margin: 0 30%;
			width: 35%;
			font-size: 150%;
			-ms-touch-action: manipulation;
			touch-action: manipulation;
			-webkit-text-decoration-skip: objects;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
			transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		}

		a.btn.flyer:hover {
			color: #fff;
			background-color: #28a745;
			border-color: #28a745;
		}

		p, h3 {
			font-size: 150%;
		}

		ul {
			margin: 20px auto;
			padding: 35px 50px;
			list-style: none;
			width: fit-content;
			border: solid 1px;
			border-radius: 10px;
			font-size: 125%;
			color: whitesmoke;
			background: linear-gradient(to bottom right, rgba(91, 149, 90, 0.75), rgba(91, 149, 90, 0.75), rgba(138, 138, 144, 0.75), rgba(138, 138, 144, 0.75));
		}
		
		@media (max-width: 576px) {
			ul, p {
				font-size: 100%;
			}
			
			p, h3 {
				margin: 35px 0px 20px;
			}
			
			h3 {
				font-size: 125%;
			}
			
			a.flyer.btn {
				margin: 0 5%;
				width: initial;
			}
		}
	</style>
</head>
<body>
    <div id="app" class="container">
		<div style="position:relative; height:100%;">
			<div style="box-sizing: border-box; width: 100% !important;">
				<h2 class="" style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px; font-size: 200%;">Philly Spades Tournament</h2>
			</div>
			<div style="">
				<h3 style="margin: 35px 35px 20px;">Team Registration:</h3>
				<ul>
					<li class="">Team Name: {{ $team->team_name }}</li>
					<li class="">Player 1: {{ $team->player_1 }}</li>
					<li class="">Player 2: {{ $team->player_2 }}</li>
				</ul>
				<p style="padding: 0px 35px 15px;">Welcome to the first annual spades tournament. This tournament is going to be the March Madness style, 6 rounds, single elimination. Championship round will be best out of 3 games. All games will start promptly at 2:00PM at American Legion Post 153<br/>2514 S 24th Street, Philadelphia, PA 19145</p>
				<p style="padding: 0px 35px 35px;">If your team has already paid, you should have received an email confirming it. If your team has not paid for the tournamet, you can click <a href="{{ route('payment', $team) }}">here</a> and select one of the options for payment. <span style="color: darkred;">If your registration fee is not paid within one week of registration, your spot will be released and you will have to re-register.</span></p>
			</div>
			<div class="downloadable_flyer">
				<a href="{{ asset('images/spades_flyer.jpg') }}" class="btn flyer">Spades Tournament Flyer</a>
			</div>
			<footer style="box-sizing: border-box; width: 100% !important;">
				<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
			</footer>
		</div>
	</div>
</body>