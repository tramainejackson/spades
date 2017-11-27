@while($rounds > 0)
	@php $totalGames = ($teams/2); @endphp
	<ul class="round round-{{ $x }}">
		<!--- Get games that are for round x from database --->
		@php $playoffSchedule = \App\Game::where('round', $x)->get(); @endphp
		@if($playoffSchedule->isNotEmpty())
			@while($playoffSchedule->isNotEmpty())
				@php $roundGames = $playoffSchedule->count(); @endphp
				@if($roundGames == ($teams/2))
					<?php if($roundGames == 1) { ?>
						<?php $playoffs = $playoffSchedule->shift(); ?>

						<li class="spacer">&nbsp;</li>
						
						<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
					<?php } else { ?>
						<?php $playoffs = $playoffSchedule->shift(); ?>
						<li class="spacer">&nbsp;</li>
						
						<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
					<?php } ?>
				@elseif(fmod(count($playoffSchedule),2) == 0)
					<?php $findGameIndex = (count($playoffSchedule) / 2); ?>
					
					<?php if($findGameIndex == 1) { ?>
						<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
						<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

						<?php if($x > 1) { ?>
							<li class="spacer">&nbsp;</li>
							
							<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
							<li class="game game-spacer">&nbsp;</li>
							<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
							
							<li class="spacer">&nbsp;</li>
							
							<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
							<li class="game game-spacer">&nbsp;</li>
							<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
						<?php } else { ?>
							<li class="spacer">&nbsp;</li>
							
							<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
							<li class="game game-spacer">&nbsp;</li>
							<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
							
							<li class="spacer">&nbsp;</li>
							
							<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
							<li class="game game-spacer">&nbsp;</li>
							<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->way_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
						<?php } ?>
					<?php } else { ?>
						<?php $playoffs = $playoffSchedule->splice($findGameIndex,1)->first(); ?>
						<?php $playoffs2 = $playoffSchedule->splice(($findGameIndex-1),1)->first(); ?>

						<li class="spacer">&nbsp;</li>
						
						<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
						
						<li class="spacer">&nbsp;</li>
						
						<li class="game game-top <?php echo $playoffs2->winning_team_id == $playoffs2->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->home_seed . ") " . $playoffs2->home_team; ?> <span><?php echo $playoffs2->home_team_score; ?></span></li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom <?php echo $playoffs2->winning_team_id == $playoffs2->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs2->away_seed . ") " . $playoffs2->away_team; ?> <span><?php echo $playoffs2->away_team_score; ?></span></li>
					<?php } ?>
				@else
					<?php $playoffs = $playoffSchedule->pop(); ?>
				
					<?php if($x > 1) { ?>
						<li class="spacer">&nbsp;</li>
						
						<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
					<?php } else { ?>
						<li class="spacer">&nbsp;</li>
						
						<li class="game game-top <?php echo $playoffs->winning_team_id == $playoffs->home_team_id ? "winner" : ""; ?>"><?php echo $playoffs->home_seed . ") " . $playoffs->home_team; ?> <span><?php echo $playoffs->home_team_score; ?></span></li>
						<li class="game game-spacer">&nbsp;</li>
						<li class="game game-bottom <?php echo $playoffs->winning_team_id == $playoffs->away_team_id ? "winner" : ""; ?>"><?php echo $playoffs->away_seed . ") " . $playoffs->away_team; ?> <span><?php echo $playoffs->away_team_score; ?></span></li>
					<?php } ?>
				@endif
			@endwhile
		@else
			@for($i=0; $i < $totalGames; $i++)
				<li class="spacer">&nbsp;</li>
				
				<li class="game game-top">TBD<span></span></li>
				<li class="game game-spacer">&nbsp;</li>
				<li class="game game-bottom ">TBD<span></span></li>
			@endfor
		@endif
		<li class="spacer">&nbsp;</li>
	</ul>
	
	@php $teams = ($teams/2); @endphp
	@php $rounds--; @endphp
	@php $x++; @endphp
@endwhile