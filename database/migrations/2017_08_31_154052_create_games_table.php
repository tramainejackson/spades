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
            $table->integer('home_team_id')->nullable();
            $table->integer('home_team_score')->nullable();
			$table->string('away_team', 100)->nullable();
            $table->integer('away_team_id')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->integer('away_seed')->nullable();
            $table->integer('home_seed')->nullable();
            $table->integer('round')->nullable();
            $table->integer('winning_team_id')->nullable();
            $table->integer('losing_team_id')->nullable();
            $table->char('forfeit', 1)->default('N');
            $table->char('game_complete', 1)->default('N');
            $table->char('playin_game', 1)->default('N');
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
