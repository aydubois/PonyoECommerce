<?php
namespace App;

use App\Cart;
use App\ProductWithQuantity;
use Illuminate\Support\Collection;

class Cart extends Collection{
    
    public static function fromSession(){
        return session()->get('cart', new Cart); 
    }

    public function save(){
        session()->put('cart', $this);
    }

    public function quantity($product){
        return optional($this->get($product->id))->quantity ?? 0;
    }

    public function add($product, $quantity = 1){
        $this[$product->id] = ProductWithQuantity::fromProductAndQuantity($product, $quantity + $this->quantity($product));
        $this->save(); 
    }

    public function modify($product, $quantity){
        $this[$product->id] = ProductWithQuantity::fromProductAndQuantity($product, $quantity);
        $this->save(); 
    }
     
    public function delete($productId){
        $this->forget($productId);
        $this->save();
    }

    public function totalPriceInCents(){
        return $this->sum('total_price_in_cents');
    }

    public static function getTotalPrice(){
        $cart = Cart::fromSession();
        $totalPrice = 0;
        if($cart->count() >= 1){
            foreach ($cart as $productWithQuantity) {
                $totalPrice += $productWithQuantity->product->price_in_cents * $productWithQuantity->quantity;
            }
        }
        return $totalPrice/100;

    }
}