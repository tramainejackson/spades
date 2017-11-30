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
	
	<!-- Icons -->
	<link href="/css/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
	
	<!-- Styles -->
	<link href="/css/app.css" rel="stylesheet" type="text/css">
	<link href="/css/mycss.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app" class="container">
		<div class="overlayBgrd"></div>
		<div class="row">
			<div class="col">
				<div class="navPlaceHolder"></div>
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
						<a class="navbar-brand d-none" href="{{ url('/') }}">
							{{ config('app.name', 'Laravel') }}
						</a>
					</div>
					
					<!--- Mobile collapsable nav -->
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
								<li class="text-center"><a class="navLink" href="{{ route('registered_teams') }}">Registered Teams</a></li>
								<li class="text-center"><a class="navLink" href="{{ route('tournament') }}">Tournament</a></li>
								<li class="text-center"><a class="navLink" href="{{ route('rules') }}">Rules</a></li>
							@else
								<li class="text-center"><a class="navLink" href="/teams">Teams</a></li>
								<li class="text-center"><a class="navLink" href="/games">Games</a></li>
								<li class="text-center"><a class="navLink" href="/setting">Settings</a></li>
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
					
					<!-- Default Nav -->
					<ul class="d-none d-sm-flex nav nav-pills nav-fill w-100">
						<!-- Authentication Links -->
						@if (Auth::guest())
							<li class="text-center nav-item"><a class="nav-link text-white" href="{{ route('welcome') }}">Home</a></li>
							<li class="text-center nav-item"><a class="nav-link text-white" href="{{ route('registration') }}">Register</a></li>
							<li class="text-center nav-item"><a class="nav-link text-white" href="{{ route('tournament') }}">Tournament</a></li>
							<li class="text-center nav-item"><a class="nav-link text-white" href="{{ route('rules') }}">Rules</a></li>
						@else
							<li class="text-center nav-item"><a class="nav-link text-white" href="/teams">Teams</a></li>
							<li class="text-center nav-item"><a class="nav-link text-white" href="/games">Games</a></li>
							<li class="text-center nav-item"><a class="nav-link text-white" href="/setting">Settings</a></li>
							<li class="text-center nav-item">
								<div class="">
									<a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
									
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</div>
							</li>
						@endif
					</ul>
				</nav>
			</div>
		</div>

		@yield('content')
    </div>
	
	<!-- Footer -->
	<script src="/js/app.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="/js/myjs.js"></script>
	@yield('footer')

</body>
</html>
