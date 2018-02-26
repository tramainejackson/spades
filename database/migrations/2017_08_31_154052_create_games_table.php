<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('home_team', 100)->nullable();
            $table->integer('home_team_id');
            $table->integer('home_team_score');
			$table->string('away_team', 100)->nullable();
            $table->integer('away_team_id');
            $table->integer('away_team_score');
            $table->integer('away_seed');
            $table->integer('home_seed');
            $table->integer('round');
            $table->integer('winning_team_id');
            $table->integer('losing_team_id');
            $table->char('forfeit', 1);
            $table->char('game_complete', 1);
            $table->char('play_in_game', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
