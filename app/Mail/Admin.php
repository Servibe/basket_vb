<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;

class Admin extends Mailable
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
        /*if (Auth::user()->id) {
            $usuario = Auth::user()->username;
        } elseif ((Auth::user()->identities[0]->provider_name) == 'facebook') {
            $usuario = Auth::user()->username;
        }*/
        $usuario = Auth::user()->username; // CAMBIAR DESPUES A USERNAME
        $from = "svitalb02@gmail.com";
        $name = "Vibe";
        $subject = "Compra de cliente";

        return $this->view('mail.admin', ['nombre'=> $usuario])
            ->from($from, $name)->subject($subject);
    }
}