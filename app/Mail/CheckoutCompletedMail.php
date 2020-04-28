<?php

namespace App\Mail;

use App\Address;
use App\Checkout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckoutCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $checkout;
    public $address;
    

    public function __construct(Checkout $checkout, Address $address)
    {
        $this->checkout = config('app.url')."/checkout/recap/".$checkout->id;
        $this->address  = $address;
        
    }

    public function build()
    {
        return $this->markdown('mails.checkout_completed');
    }
}
