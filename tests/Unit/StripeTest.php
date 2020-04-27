<?php

namespace Tests\Unit;

use App\Stripe1;
use PHPUnit\Framework\TestCase;
use App\Exceptions\StripeException;

class StripeTest extends TestCase
{
    const LAST4 = [
        'tok_visa'=>'4242',  //token test stripe
    ];

    /** @test */
    function itWorkTest(){
        $stripe = app(Stripe1::class);
        $last4 = $stripe->charge('tok_visa', 10*100); //recupere 4 derniers chiffres CB / 10*100 centimes

        $this->assertEquals(self::LAST4['tok_visa'], $last4);
    }


    /** @test */
    function itDoesntWorkTest(){
        $stripe = app(Stripe1::class);
        try{
            dd($stripe->charge('token_invalid', 10*100));
        }catch(StripeException $e){
            $this->assertTrue(true);
            return;
        }

        $this->fail('Stripe succeeded');
    }
}
