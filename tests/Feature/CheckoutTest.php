<?php

namespace Tests\Feature;

use App\Address;
use App\Product;
use App\Stripe1;
use App\Checkout;
use App\StripeFake;
use Tests\TestCase;
use Tests\Unit\StripeTest;
use App\ProductWithQuantity;
use App\Mail\CheckoutCompletedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function itWorkTest(){
        $this->withoutExceptionHandling(); 
        $stripeF = Stripe1::fake();
        Mail::fake();

        $product = factory(Product::class)->create([
            'price_in_cents' => 5*100,

        ]);
    
        $this->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 3,
        ])->assertRedirect(); 
    
        $response =   $this->post('/checkout', [
            'stripe_token'=>'tok_visa',

            'email'=> 'bouh@example.com',
            'billing_address' => [
                'name1' => 'bouh',
                'line1' => '4 rue de la nuit',
                'line2' => 'app 343',
                'line3' => '',
                'postcode' => '47430', 
                'city' => 'Paris',
                'country' => 'FR',
            ],
        ]);
        $response->assertRedirect('/'); 

        $addresses = Address::all();
        $this->assertCount(1, $addresses);

        $address = $addresses->first();
        $this->assertEquals('bouh', $address->name1);
        $this->assertEquals('4 rue de la nuit', $address->line1);
        $this->assertEquals('app 343', $address->line2);
        $this->assertNull($address->line3);
        $this->assertEquals('47430', $address->postcode);
        $this->assertEquals('Paris', $address->city);
        $this->assertEquals('FR', $address->country);


        $productsWithQuantities = ProductWithQuantity::all();
        $this->assertCount(1, $productsWithQuantities );
        
        $productWithQuantity = $productsWithQuantities->first();
        $this->assertTrue($productWithQuantity->product->is($product));
        $this->assertEquals(3, $productWithQuantity->quantity);

        $checkouts = Checkout::all();
        $this->assertCount(1, $checkouts);
        $checkout = $checkouts->first(); 
        $this->assertEquals(StripeTest::LAST4['tok_visa'], $checkout->card_last4);
        $this->assertTrue($checkout->billingAddress->is($address));
        $this->assertCount(1, $checkout->productsWithQuantities);

        $this->assertTrue($checkout->productsWithQuantities->first()->is($productWithQuantity)); 

        $charges = $stripeF->getChargesFor('tok_visa');
        $this->assertCount(1, $charges);
        $this->assertEquals(3*5*100, $charges->first());

        Mail::assertSent(CheckoutCompletedMail::class, function($mail) use($checkout){
            return $mail->hasTo('bouh@example.com')
                and $mail->checkout->is($checkout);
        });
    
    }


    protected function notEmptyCart(){
        $product = factory(Product::class)->create();
    
        $this->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 3,
        ])->assertRedirect();

        return $this;
    }

    protected function validParams($overrides = []){
        return arrays_merge_recursive_distinct([
            'billing_address' => [
                'name1' => 'Ba nane',
                'line1' => '4 rue de la nuit',
                'line2' => 'app 343',
                'line3' => '',
                'postcode' => '47430', 
                'city' => 'Paris',
                'country' => 'FR',
            ],
        ], $overrides);
    }

    /** @test */
    function billingAddressNameRequiredTest(){

        $this->notEmptyCart()
            ->post('/checkout', $this->validParams([
            'billing_address' => [
                'name1' => '',
            ],
        ]))->assertSessionHasErrors('billing_address.name1');
        $this->assertEquals(0, Checkout::count());

    }

        /** @test */
        function billingAddressLine1RequiredTest(){

            $this->notEmptyCart()
            ->post('/checkout', $this->validParams([
            'billing_address' => [
                'line1' => '',
            ],
        ]))->assertSessionHasErrors('billing_address.line1');
    
        } 
}
