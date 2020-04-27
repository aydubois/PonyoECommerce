<?php

namespace App\Mail;

use App\Checkout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckoutCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $checkout;
    

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function build()
    {
        return $this->markdown('mails.checkout_completed');
    }
}
