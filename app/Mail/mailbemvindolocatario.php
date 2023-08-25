<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class mailbemvindolocatario extends Mailable
{
    use Queueable, SerializesModels;
     
    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $objDados;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objDados)
    {
        $this->objDados = $objDados;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('suporte@compdados.com.br')
                    ->subject('Seja muito bem vindo a nossa imobiliária')
                    ->view('mail.bemvindolocatario');
    }
}