<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Address;
use App\Product;
use App\Stripe1;
use App\Checkout;
use App\ProductWithQuantity;
use Illuminate\Http\Request;
use App\Mail\CheckoutCompletedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{


    public function index(){
        return view('checkout.index');
    }

    /**
     * Vérification de l'addresse de facturation
     *Si tout est Ok -> Etape de facturation
     */
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
        session()->put('address', $address);
        //dd(session('cart'));
        return view('checkout.paiement', ['address'=> $address, 'productsWithQuantities' => Cart::fromSession()]);
    
    }

    /**
     * Vérification du retour de stripe
     */
    public function paie(){

        request()->validate([
            'stripeEmail' => ['required'],
        ]);

        $cart = Cart::fromSession();
        $address = session()->get('address');
        $retourStripe = app(Stripe1::class)->charge(request('stripeToken'), $cart->totalPriceInCents());
        
        if($retourStripe->paid === true && $retourStripe->status === "succeeded"){
            $checkout = Checkout::create([
                'card_last4' => $retourStripe->source->last4,
                'billing_address_id' => $address->id ,
            ]);
                
            //pour chaque produit du panier ->enregistrement
            Cart::fromSession()->each(function($productWithQuantity) use ($checkout){
                $checkout->productsWithQuantities()->save($productWithQuantity);
            });
            
            
            Mail::to(request("stripeEmail"))->send(new CheckoutCompletedMail($checkout, Address::find($address->id) )) ;

            //suppression de la commande dans la session si pas d'authentification
            session()->forget('cart');

            return view('checkout.valid')->with(['last4'=>$retourStripe->source->last4, 'name'=>$address->name1, 'email'=>\request('stripeEmail')]);
        
        }else{
            
            return view('checkout.paiement', ['address'=> $address, 'productsWithQuantities' => Cart::fromSession()])->withErrors('message', 'Une erreur est survenue lors du paiement. Veuillez réessayer.');
        }
    }


    public function recap($checkoutId){
        $productsQuantities = ProductWithQuantity::where('checkout_id' , $checkoutId)->get();
        $array = [];
        $total = 0;
        foreach ($productsQuantities as $data) {
            $product = Product::find($data->product_id);

            array_push($array, ['name'=> $product->title, 
            'quantity'=> $data->quantity, 
            'price_in_cents'=>$product->price_in_cents]);
            
            $total += $product->price_in_cents;
        }
        // dd($array);
        return view('checkout.recap', ['listingProducts' => $array, 'total'=>$total]);
    }
}
