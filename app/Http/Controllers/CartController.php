<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductWithQuantity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    public function index(){
        //envoie les données de la session . Si vide -> passe un tableau null (collect)
        return view('cart.index', ['productsWithQuantities' => Cart::fromSession()] ); 
    }

    public function store(){

        //vérification de la quantity
        request()->validate([
            'quantity'=>['integer', 'min:1'],
        ]);

        $product = Product::findOrFail(request('product_id')); //retourne une erreur 404 si le produit n'existe pas
        
        //recupération du panier existant
        Cart::fromSession()
            //ajoute l'élément du panier dans la session 
            ->add($product, request('quantity', 1));

        
            return redirect()->route('products.show', ['id'=> request('product_id')])->with('success_message', 'Cette adorable créature a bien été mise dans votre panier !');
        
    }

    public function update(){
        //vérification de la quantity
        request()->validate([
            'quantity'=>['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail(request('product_id'));  
        Cart::fromSession()
            ->modify($product, request('quantity'));
        

        return redirect()->route('cart.index')->with('success_message', 'Cette adorable créature a bien été mise dans votre panier !');
    }


    public function delete(){
        $cart = Cart::fromSession()
            ->delete(request('product_id'));

            return redirect()->route('cart.index')->with('success_message', 'Cette adorable créature a bien été mise dans votre panier !');

    }
}
