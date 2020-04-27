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

        // `source` is obtained with Stripe.js; see https://stripe.com/docs/payments/accept-a-payment-charges#web-create-token
        try{
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'source' => $token,
                'description' => 'My First Test Charge (created for API docs)',
                ]);
                
                //return $charge->source->last4;
                return $charge;
        }catch(InvalidRequest $e){
            throw new StripeException;
        }
    }

}
