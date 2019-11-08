<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Pedido;
use Auth;

class UserM extends Mailable
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
        $usuario = Auth::user()->cliente->nombre;
        $from = "svitalb02@gmail.com";
        $name = "Vibe";
        $subject = "Realización de compra";

        return $this->view('mail.userM', ['nombre'=> $usuario])
            ->from($from, $name)->subject($subject);
    }
}