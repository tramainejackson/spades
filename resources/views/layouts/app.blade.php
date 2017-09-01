<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Spades Tournament</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet" type="text/css">
	
	<!-- Styles -->
	<link href="/css/app.css" rel="stylesheet" type="text/css">
	<link href="/css/mycss.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app" class="container">
		<div class="overlayBgrd"></div>
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-default navbar-static-top">
					<div class="navbar-header">

						<!-- Collapsed Hamburger -->
						<button type="button" class="navbar-toggle collapsed fixed-top d-sm-none m-1 border-0 menuMobile" data-toggle="collapse" data-target="#app-navbar-collapse">
							<span class="sr-only">Toggle Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<!-- Branding Image -->
						<a class="navbar-brand d-none d-sm-none" href="{{ url('/') }}">
							{{ config('app.name', 'Laravel') }}
						</a>
					</div>

					<div class="collapse navbar-collapse" id="app-navbar-collapse">
						<!-- Left Side Of Navbar -->
						<ul class="nav navbar-nav">
							&nbsp;
						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="nav navbar-nav navbar-right">
							<!-- Authentication Links -->
							@if (Auth::guest())
								<li class="text-center"><a class="navLink" href="{{ route('welcome') }}">Home</a></li>
								<li class="text-center"><a class="navLink" href="{{ route('registration') }}">Register</a></li>
								<li class="text-center"><a class="navLink" href="{{ route('tournament') }}">Tournament</a></li>
								<li class="text-center"><a class="navLink" href="{{ route('rules') }}">Rules</a></li>
							@else
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
										{{ Auth::user()->name }} <span class="caret"></span>
									</a>

									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="{{ route('logout') }}"
												onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
												Logout
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>
		</div>

		@yield('content')
    </div>
	
	<!-- Footer -->
	<footer class="d-flex flex-column justify-content-center bg-dark text-white text-center">
		<p class="">10% of all proceeds will be donated to charity</p>
		<p class="">Sponcered By: </p>
		<p class="">Organized By: </p>
		<div class="">
			<div class="">
				<h5 class="mb-0">&reg;&nbsp;Registered by Tramaine</h5>
			</div>
		</div>
	</footer>
	<div class="" style=""></div>
	<script src="/js/app.js"></script>
	<script src="/js/myjs.js"></script>
	
	@yield('footer')

</body>
</html>
