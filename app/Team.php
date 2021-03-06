<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_1', 'player_2', 'email', 'team_name',
    ];
	
	/**
     * Get the games for the team.
     */
    public function games()
    {
        return $this->hasMany('App\Game');
    }
}
