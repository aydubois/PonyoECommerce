<?php

namespace App;

use App\Stripe1;
use App\Exceptions\StripeException;

class StripeFake 
{
    public $charges;

    public function __construct(){
        $this->charges = collect();
    }

    public function charge($token, $amount){
        if($token === 'tok_visa'){
            $this->charges[$token] = $this->getChargesFor($token)->push($amount);  //recupération des paiements deja effectué avec le token et ajout du nouveau paiement
            return '4242';
        }
        throw new StripeException; 
    }

    public function getChargesFor($token){
         return $this->charges->get($token, collect());
    }
}
