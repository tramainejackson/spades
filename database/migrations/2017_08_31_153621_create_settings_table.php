<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_teams');
            $table->integer('teams_with_bye');
            $table->integer('total_rounds');
            $table->char('playin_games', 1)->default('N');
            $table->char('playin_games_complete', 1)->default('N');
            $table->string('champion', 50)->nullable();
            $table->integer('champion_id');
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
        Schema::dropIfExists('settings');
    }
}
