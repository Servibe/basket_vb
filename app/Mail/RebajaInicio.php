<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Producto;

class RebajaInicio extends Mailable
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
        $fecha_inicio = now()->toDateString();

        $fecha_fin = Producto::select('rebaja_fin')->where('rebaja_inicio', $fecha_inicio)->orderBy('updated_at', 'DESC')->first()->rebaja_fin;

        $nombre = Producto::select('nombre')->where('rebaja_inicio', $fecha_inicio)->orderBy('updated_at', 'DESC')->first()->nombre;

        $rebaja = Producto::select('rebajado')->where('rebaja_inicio', $fecha_inicio)->orderBy('updated_at', 'DESC')->first()->rebajado;

        $from = 'svitalb02@gmail.com';
        $name = 'Vibe';
        $subject = 'Nuevo producto añadido a rebajas';

        return $this->view('mail.rebajaI', ['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin,
            'nombre' => $nombre, 'rebaja' => $rebaja])
        ->from($from, $name)->subject($subject);
    }
}
