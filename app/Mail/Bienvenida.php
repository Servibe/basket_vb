<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;

class Bienvenida extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuario = Auth::user()->username;
        $from = "svitalb02@gmail.com";
        $name = "Basket VB";
        $subject = "Bienvenid@ a Basket VB";

        return $this->view('mail.bienvenida', ['nombre'=> $usuario])
            ->from($from, $name)->subject($subject);
    }
}
