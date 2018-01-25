@extends('layouts.app')
	@section('addt_style')
		<style>
			@media (max-width: 767px) {
				#champ_modal .modal-dialog {
					width: 90% !important;
					left: 3% !important;
					top: 5% !important;
				}
			}
		</style>
	@endsection
	
	@section('content')
		<div class="row flex-column align-items-center justify-content-center welcomeHeader" style="position:relative">
			<div class="text-white my-5 fullHeight" style="">
				<h1 class="text-center">Philly</h1>
				<h1 class="text-center">Spades</h1>
				<h1 class="text-center text-truncate">Tournament</h1>
				<h1 class="text-center">2018</h1>
			</div>
		
			@if($setting->champion != null)
				@php $champTeam = \App\Team::where('id', $setting->champion_id)->first(); @endphp
				<div class="modal fade" id="champ_modal">
					 <div class="modal-dialog" role="document" style="position: absolute; left: 35%;width: 50%;">
						<div class="modal-content">
						  <div class="modal-header">
							<h3 class="modal-title text-center">2018 Champions</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body">
							  <div class="py-3 px-1 rounded mb-1" style="background: darkgreen; color: white;">
								<h2 class="text-center">{{ $champTeam->team_name }}</h2>
								<p class="m-0 py-1"><span>Player #1 - </span><span>{{ $champTeam->player_1 }}</span></p>
								<p class="m-0 py-1"><span>Player #2 - </span><span>{{ $champTeam->player_2 }}</span></p>
							  </div>
							<p>Congrats to our 2018 Champions of the 1st annual Philly Spades Tournament. They worked their way through a 64 team bracket and came out on top for the grand prize.</p>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						  </div>
						</div>
					  </div>
					@include('fireworks')
				</div>
			@endif
			
			<div class="">
				<div class="bg-white py-5 px-3 fullHeight">
					<h2 class="text-center pb-4 mb-3 mx-3 display-2" style="border-bottom:1px solid gray">Welcome</h2>
					<p class="px-sm-5">Welcome to the first annual spades tournament. This tournament is going to be the March Madness style, 64 team bracket. The first 64 teams to register will get a chance to reserve a spot to become the first true spade champion of Philly. Click <a href="{{ route('registration') }}" class="text-dark"><u>here</u></a> to register.</p>
					<p class="px-sm-5">Of course everybody plays the game a little differently depending on where you're from so we have narrowed down the rules to most common way of playing. Check out the list of rules <a href="/rules" class="text-dark"><u>here</u>.</a> Rules will be attached to every table for each game</p>
					<p class="px-sm-5">There will be a grand prize for the winner (a check will be given to the winning team). If all 64 slots are satisfied, the grand prizes will be $1,000.</p>
					<p class="px-sm-5">There will also be a light buffet and non-alcoholic available. The event will be BYOB. All games will start promptly at 2:00PM on Sunday April 15th.</p>
					<p class="px-sm-5 text-center"><a class="btn btn-lg btn-outline-success" href="{{ asset('/images/spades_flyer.jpg') }}" target="_blank">Spades Tournament Flyer</a></p>
				</div>
			</div>
		
			<div class="py-5 px-3 text-white fullHeight">
				<h2 class="text-center pb-4 mb-3 mx-3 display-4">Registration</h2>
				<p class="px-sm-5">To register a team click <a href="{{ route('registration') }}" class="text-light"><u>here</u></a>. The entry fee for every team will be $70. It is first come first serve and registration will close once we have reached 64 teams. There is a no refund policy so please make sure that you provide a correct email address for notification of time and place of tournament.</p>
				<p class="px-sm-5">If you have any questions or concerns, please feel free to email us any time at <a href="mailto:spades2spades@gmail" class="text-light"><u>spades2spades@gmail</u>.</a></p>
			</div>
		</div>
	@endsection
	
	@section('footer')
		
		@include('footer')
		
		<script type="text/javascript">
			$('nav ul li:first-of-type a').addClass('active');			
		</script>
		
		@if($setting->champion != null)
			<script type="text/javascript">
				// when animating on canvas, it is best to use requestAnimationFrame instead of setTimeout or setInterval
				// not supported in all browsers though and sometimes needs a prefix, so we need a shim
				window.requestAnimFrame = ( function() {
					return window.requestAnimationFrame ||
								window.webkitRequestAnimationFrame ||
								window.mozRequestAnimationFrame ||
								function( callback ) {
									window.setTimeout( callback, 1000 / 60 );
								};
				})();

				// now we will setup our basic variables for the demo
				var canvas = document.getElementById( 'canvas' ),
						ctx = canvas.getContext( '2d' ),
						// full screen dimensions
						cw = window.innerWidth,
						ch = window.innerHeight,
						// firework collection
						fireworks = [],
						// particle collection
						particles = [],
						// starting hue
						hue = 120,
						// when launching fireworks with a click, too many get launched at once without a limiter, one launch per 5 loop ticks
						limiterTotal = 5,
						limiterTick = 0,
						// this will time the auto launches of fireworks, one launch per 80 loop ticks
						timerTotal = 80,
						timerTick = 0,
						mousedown = false,
						// mouse x coordinate,
						mx,
						// mouse y coordinate
						my;
						
				// set canvas dimensions
				canvas.width = cw;
				canvas.height = ch;

				// now we are going to setup our function placeholders for the entire demo

				// get a random number within a range
				function random( min, max ) {
					return Math.random() * ( max - min ) + min;
				}

				// calculate the distance between two points
				function calculateDistance( p1x, p1y, p2x, p2y ) {
					var xDistance = p1x - p2x,
							yDistance = p1y - p2y;
					return Math.sqrt( Math.pow( xDistance, 2 ) + Math.pow( yDistance, 2 ) );
				}

				// create firework
				function Firework( sx, sy, tx, ty ) {
					// actual coordinates
					this.x = sx;
					this.y = sy;
					// starting coordinates
					this.sx = sx;
					this.sy = sy;
					// target coordinates
					this.tx = tx;
					this.ty = ty;
					// distance from starting point to target
					this.distanceToTarget = calculateDistance( sx, sy, tx, ty );
					this.distanceTraveled = 0;
					// track the past coordinates of each firework to create a trail effect, increase the coordinate count to create more prominent trails
					this.coordinates = [];
					this.coordinateCount = 3;
					// populate initial coordinate collection with the current coordinates
					while( this.coordinateCount-- ) {
						this.coordinates.push( [ this.x, this.y ] );
					}
					this.angle = Math.atan2( ty - sy, tx - sx );
					this.speed = 2;
					this.acceleration = 1.05;
					this.brightness = random( 50, 70 );
					// circle target indicator radius
					this.targetRadius = 1;
				}

				// update firework
				Firework.prototype.update = function( index ) {
					// remove last item in coordinates array
					this.coordinates.pop();
					// add current coordinates to the start of the array
					this.coordinates.unshift( [ this.x, this.y ] );
					
					// cycle the circle target indicator radius
					if( this.targetRadius < 8 ) {
						this.targetRadius += 0.3;
					} else {
						this.targetRadius = 1;
					}
					
					// speed up the firework
					this.speed *= this.acceleration;
					
					// get the current velocities based on angle and speed
					var vx = Math.cos( this.angle ) * this.speed,
							vy = Math.sin( this.angle ) * this.speed;
					// how far will the firework have traveled with velocities applied?
					this.distanceTraveled = calculateDistance( this.sx, this.sy, this.x + vx, this.y + vy );
					
					// if the distance traveled, including velocities, is greater than the initial distance to the target, then the target has been reached
					if( this.distanceTraveled >= this.distanceToTarget ) {
						createParticles( this.tx, this.ty );
						// remove the firework, use the index passed into the update function to determine which to remove
						fireworks.splice( index, 1 );
					} else {
						// target not reached, keep traveling
						this.x += vx;
						this.y += vy;
					}
				}

				// draw firework
				Firework.prototype.draw = function() {
					ctx.beginPath();
					// move to the last tracked coordinate in the set, then draw a line to the current x and y
					ctx.moveTo( this.coordinates[ this.coordinates.length - 1][ 0 ], this.coordinates[ this.coordinates.length - 1][ 1 ] );
					ctx.lineTo( this.x, this.y );
					ctx.strokeStyle = 'hsl(' + hue + ', 100%, ' + this.brightness + '%)';
					ctx.stroke();
					
					ctx.beginPath();
					// draw the target for this firework with a pulsing circle
					ctx.arc( this.tx, this.ty, this.targetRadius, 0, Math.PI * 2 );
					ctx.stroke();
				}

				// create particle
				function Particle( x, y ) {
					this.x = x;
					this.y = y;
					// track the past coordinates of each particle to create a trail effect, increase the coordinate count to create more prominent trails
					this.coordinates = [];
					this.coordinateCount = 5;
					while( this.coordinateCount-- ) {
						this.coordinates.push( [ this.x, this.y ] );
					}
					// set a random angle in all possible directions, in radians
					this.angle = random( 0, Math.PI * 2 );
					this.speed = random( 1, 10 );
					// friction will slow the particle down
					this.friction = 0.95;
					// gravity will be applied and pull the particle down
					this.gravity = 1;
					// set the hue to a random number +-50 of the overall hue variable
					this.hue = random( hue - 50, hue + 50 );
					this.brightness = random( 50, 80 );
					this.alpha = 1;
					// set how fast the particle fades out
					this.decay = random( 0.015, 0.03 );
				}

				// update particle
				Particle.prototype.update = function( index ) {
					// remove last item in coordinates array
					this.coordinates.pop();
					// add current coordinates to the start of the array
					this.coordinates.unshift( [ this.x, this.y ] );
					// slow down the particle
					this.speed *= this.friction;
					// apply velocity
					this.x += Math.cos( this.angle ) * this.speed;
					this.y += Math.sin( this.angle ) * this.speed + this.gravity;
					// fade out the particle
					this.alpha -= this.decay;
					
					// remove the particle once the alpha is low enough, based on the passed in index
					if( this.alpha <= this.decay ) {
						particles.splice( index, 1 );
					}
				}

				// draw particle
				Particle.prototype.draw = function() {
					ctx. beginPath();
					// move to the last tracked coordinates in the set, then draw a line to the current x and y
					ctx.moveTo( this.coordinates[ this.coordinates.length - 1 ][ 0 ], this.coordinates[ this.coordinates.length - 1 ][ 1 ] );
					ctx.lineTo( this.x, this.y );
					ctx.strokeStyle = 'hsla(' + this.hue + ', 100%, ' + this.brightness + '%, ' + this.alpha + ')';
					ctx.stroke();
				}

				// create particle group/explosion
				function createParticles( x, y ) {
					// increase the particle count for a bigger explosion, beware of the canvas performance hit with the increased particles though
					var particleCount = 30;
					while( particleCount-- ) {
						particles.push( new Particle( x, y ) );
					}
				}

				// main demo loop
				function loop() {
					// this function will run endlessly with requestAnimationFrame
					requestAnimFrame( loop );
					
					// increase the hue to get different colored fireworks over time
					//hue += 0.5;
				  
				  // create random color
				  hue= random(0, 360 );
					
					// normally, clearRect() would be used to clear the canvas
					// we want to create a trailing effect though
					// setting the composite operation to destination-out will allow us to clear the canvas at a specific opacity, rather than wiping it entirely
					ctx.globalCompositeOperation = 'destination-out';
					// decrease the alpha property to create more prominent trails
					ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
					ctx.fillRect( 0, 0, cw, ch );
					// change the composite operation back to our main mode
					// lighter creates bright highlight points as the fireworks and particles overlap each other
					ctx.globalCompositeOperation = 'lighter';
					
					// loop over each firework, draw it, update it
					var i = fireworks.length;
					while( i-- ) {
						fireworks[ i ].draw();
						fireworks[ i ].update( i );
					}
					
					// loop over each particle, draw it, update it
					var i = particles.length;
					while( i-- ) {
						particles[ i ].draw();
						particles[ i ].update( i );
					}
					
					// launch fireworks automatically to random coordinates, when the mouse isn't down
					if( timerTick >= timerTotal ) {
						if( !mousedown ) {
							// start the firework at the bottom middle of the screen, then set the random target coordinates, the random y coordinates will be set within the range of the top half of the screen
							fireworks.push( new Firework( cw / 2, ch, random( 0, cw ), random( 0, ch / 2 ) ) );
							timerTick = 0;
						}
					} else {
						timerTick++;
					}
					
					// limit the rate at which fireworks get launched when mouse is down
					if( limiterTick >= limiterTotal ) {
						if( mousedown ) {
							// start the firework at the bottom middle of the screen, then set the current mouse coordinates as the target
							fireworks.push( new Firework( cw / 2, ch, mx, my ) );
							limiterTick = 0;
						}
					} else {
						limiterTick++;
					}
				}

				// mouse event bindings
				// update the mouse coordinates on mousemove
				canvas.addEventListener( 'mousemove', function( e ) {
					mx = e.pageX - canvas.offsetLeft;
					my = e.pageY - canvas.offsetTop;
				});

				// toggle mousedown state and prevent canvas from being selected
				canvas.addEventListener( 'mousedown', function( e ) {
					e.preventDefault();
					mousedown = true;
				});

				canvas.addEventListener( 'mouseup', function( e ) {
					e.preventDefault();
					mousedown = false;
				});

				// once the window loads, we are ready for some fireworks!
				window.onload = loop;


			</script>
		
			<script type="text/javascript">
				$('#champ_modal').modal('show');
			</script>
		@endif
	@endsection