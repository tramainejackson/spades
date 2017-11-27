<?php

namespace App\Http\Controllers;

use App\Team;
use App\Mail\Confirmation;
use Illuminate\Support\Facades\Mail;
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
        $this->middleware('auth')->except('store');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$teams = Team::all();
        return view('teams.index', compact('teams'));
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
			
			if($request->pif == null) {
				$team->save();
				// Mail::to($team->email)->send(new Confirmation($team));
				return view('payment', compact('team'));
			} else {
				$team->pif = $request->pif;
				$team->save();
				return redirect()->action('TeamController@index');
			}

			$setting->remove_active_games();
			$setting->create_tourney_settings();			

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
        $team->delete();
		return redirect()->action('TeamController@index');
    }
}
