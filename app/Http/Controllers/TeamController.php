<?php

namespace App\Http\Controllers;

use App\Team;
use App\Mail\Confirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeamController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'index']);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::guest()) {
			$teams = Team::where('pif', 'Y')->get();
			return view('teams', compact('teams'));
		} else {
			$teams = Team::all();
			return view('teams.index', compact('teams'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$setting = \App\Setting::find(1);
		$teams = Team::all();

		if($teams->count() < 64) {
			$team = new Team;
			$team->team_name = $request->team_name;
			$team->player_1 = $request->player1;
			$team->player_2 = $request->player2;
			$team->email = $request->email;
			$team->pif = $request->pif == '' ? 'N' : $request->pif;
			$team->save();

			Log::info('Add Team ID('.$team->id.'): Team Name: '.$team->team_name.' | Player #1: '.$team->player_1.', Player #2: '.$team->player_2);
			
			$setting->remove_active_games();
			$setting->create_tourney_settings();			

			if($request->pif == null) {
				\Mail::to($team->email)->send(new Confirmation($team));
				return view('payment', compact('team'));
			} else {
				return redirect()->action('TeamController@index')->with('status', 'Team added successfully');
			}

		} else {
			return redirect()->action('TeamController@index')->with('status', 'The max amount of teams (64 teams) has been reached and we are not accepting any more entries');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
		$teams = Team::findOrfail($team)->first();
        return view('teams.edit', compact('teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team->player_1 = $request->player_1;
        $team->player_2 = $request->player_2;
        $team->email = $request->email;
        $team->team_name = $request->team_name;
        $team->pif = $request->pif;
        $team->save();
		
		// dd($request);
		
		return redirect()->action('TeamController@edit', [$team]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
		$setting = \App\Setting::find(1);
		
        if($team->delete()) {
			// Remove all tourney games and recreate tourney once delete is complete
			$setting->remove_active_games();
			$setting->create_tourney_settings();			
		}

		return redirect()->action('TeamController@index');
    }
}
