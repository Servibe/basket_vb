<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;

class Desactivada extends Mailable
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
        $usuario = Auth::user()->cliente->nombre . " " . Auth::user()->cliente->apellidos;
        $referencia = Auth::user()->username;
        $from = "svitalb02@gmail.com";
        $name = "Basket VB";
        $subject = "Suspensión de cuenta";

        return $this->view('mail.desactivada', ['nombre'=> $usuario, 'nickname' => $referencia])
            ->from($from, $name)->subject($subject);
    }
}
