<?php

namespace App\Mail;

use App\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;
	
	/**
	* The team instance
	*
	* @var team
	*/
	public $team;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Spades King Tournament Confirmation')->view('emails.confirm', compact('team'));
    }
}
