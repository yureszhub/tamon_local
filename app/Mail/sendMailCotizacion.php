<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMailCotizacion extends Mailable
{
    use Queueable, SerializesModels;

    public $data_cotizacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_cotizacion)
    {
        $this->data_cotizacion = $data_cotizacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cotizacion');
    }
}
