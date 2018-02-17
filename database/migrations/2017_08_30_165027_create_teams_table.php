<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('team_name', 50)->nullable();
            $table->string('player_1', 50)->nullable();
            $table->string('player_2', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->char('pif', 1)->default('N');
            $table->char('admin_created', 1)->default('N');
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
        Schema::dropIfExists('teams');
    }
}
