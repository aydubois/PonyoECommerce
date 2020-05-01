<?php

namespace App;
use Stripe\Charge;
use Stripe\Stripe;
use App\StripeFake;
use Stripe\Error\InvalidRequest;
use App\Exceptions\StripeException;

class Stripe1 
{
    public static function fake(){
        return  app()->instance(self::class, new StripeFake);
    }
    public static function charge($token, $amount){
        \Stripe\Stripe::setApiKey('sk_test_5mRUCY5Sh0YkQrjxE8r27zpV00bhJXXf8l');

        try{
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'source' => $token,
                'description' => 'Site Ponyo Ecommerce, vente d\'animaux en ligne',
                ]);
                return $charge;
            } catch (\Stripe\Exception\CardException $e) {
            
                return view('checkout.paiement', ['address'=> session()->get('address'), 'productsWithQuantities' => Cart::fromSession()])->withErrors('error');
            }
    
    }

}
