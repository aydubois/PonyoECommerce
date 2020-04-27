<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Address;
use App\Stripe1;
use App\Checkout;
use Illuminate\Http\Request;
use App\Mail\CheckoutCompletedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{

    public function index(){
        return view('checkout.index');
    }
    public function store(){
        request()->validate([
            'name1' => ['required'],
            'line1' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],

        ]);
        $address = Address::create([
            'name1' => request('name1'),
            'line1' => request('line1'),
            'line2' => request('line2'),
            'line3' => request('line3'),
            'postcode' => request('postcode'), 
            'city' => request('city'),
            'country' => request('country'),
        ]); 
        // dd(request());
        $cart = Cart::fromSession();

        $retourStripe = app(Stripe1::class)->charge(request('stripeToken'), $cart->totalPriceInCents());
        $checkout = Checkout::create([
            'card_last4' => $retourStripe->source->last4,
            'billing_address_id' => $address->id ,
        ]);
        
        //pour chaque produit du panier ->enregistrement
        Cart::fromSession()->each(function($productWithQuantity) use ($checkout){
            $checkout->productsWithQuantities()->save($productWithQuantity);
        });

        
        Mail::to(request("stripeEmail"))->send(new CheckoutCompletedMail($checkout )) ;
        return view('test')->with(['retourStripe'=> $retourStripe]);
       
    }
}
