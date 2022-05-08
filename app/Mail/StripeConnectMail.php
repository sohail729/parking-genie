<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StripeConnectMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    public $stripeLink;
   
    public function __construct($stripeLink)
    {
        $this->stripeLink = $stripeLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@parkinggenie.com', 'Parking Genie')
        ->subject('Signup Confirmation | Parking Genie')
        ->view('mail.stripe-connect');
    }
}
