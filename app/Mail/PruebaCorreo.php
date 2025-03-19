<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PruebaCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Correo de Prueba')
                    ->view('emails.prueba');
    }
}
