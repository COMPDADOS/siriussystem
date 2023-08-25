<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailEnvioMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( \stdClass $user )
    {
        $this->user = $user;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Estudando...');
        $this->to( $this->user->clienteemail, $this->user->clientenome);
        
        return $this->markdown('mail.envio-email', [
                'user' => $this->user ]);
    }
}
