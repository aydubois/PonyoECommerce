<?php

namespace App\Http\Controllers;

use App\Address;
use App\Product;
use App\Checkout;
use App\ProductWithQuantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        
        return view('account.index')->with( 'user', auth()->user());

    }

    public function update(){
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:6|confirmed',
        ]);

        $user = auth()->user();
        $input = request()->except('password', 'password_confirmation');

        if (! request()->filled('password')) {
            $user->fill($input)->save();

            return back()->with('success_message', 'Ton profil a bien été mis à jour!');
        }

        $user->password = bcrypt(request()->password);
        $user->fill($input)->save();

        return back()->with('success_message', 'Ton profil et ton mot de passe ont bien été mis à jour!');
    
    }

    public function orders(){
        $checkouts = Checkout::where('user_id', Auth::user()->id )->get();
        $array = [];
        $i = 1;
        foreach ($checkouts as $value) {
            $totalPrice = 0;
            $dateCreation = $value->created_at->format('d/m/Y');
            // dd($dateCreation);
            $array2 = [];
            $productsWithQuantities = ProductWithQuantity::where('checkout_id', $value->id)->get();
            foreach ($productsWithQuantities as $value) {
                $product = Product::find($value->product_id);
                $price = $product->price_in_cents;
                $nameProduct = $product->title;
                $quantity = $value->quantity;
                array_push($array2, [
                    'checkout' => $i,
                    'nameProduct' => $nameProduct,
                    'quantity' => $quantity,
                    'price' => $price,
                    ]);
                    
                    $totalPrice+=$price*$quantity;
                }
            array_push($array, [$array2, $totalPrice, $dateCreation]);
            $totalPrice = 0;
            $i++;
        }
        
        return view('account.orders', ['checkouts'=> $array]);
    }
    public function address(){
        $user_id = auth()->user()->id;
        $addresses = Address::where(['user_id'=> $user_id, 'type'=> 'facturation'])->orderBy('updated_at')->first();
        $nbaddresses = Address::where(['user_id'=> $user_id, 'type'=> 'facturation'])->count();
        
        return view('account.address')->with(['Address'=> $addresses, 'user'=> auth()->user(), 'nbAddress'=>$nbaddresses]);
    }
    public function addAddress(){
        request()->validate([
            'name1' => ['required'],
            'line1' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'user_id' => ['required']

        ]);
        $address = Address::create([
            'name1' => request('name1'),
            'user_id' => request('user_id'),
            'line1' => request('line1'),
            'line2' => request('line2'),
            'line3' => request('line3'),
            'postcode' => request('postcode'), 
            'city' => request('city'),
            'country' => request('country'),
        ]); 
        session()->put('address', $address);
        return back()->with('success_message', 'Ton adresse a bien été mise à jour!');
    }
    public function patchAddress(){
        request()->validate([
            'name1' => ['required'],
            'line1' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'user_id' => ['required']
        ]);
        $user_id = Auth::user()->id;
        $address = Address::where(['user_id'=> $user_id, 'type'=> 'facturation'])->orderBy('updated_at')->first(); 
        $newAddress = Address::find($address->id)->update([
            'name1' => request('name1'),
            'line1' => request('line1'),
            'line2' => request('line2'),
            'line3' => request('line3'),
            'postcode' => request('postcode'), 
            'city' => request('city'),
            'country' => request('country'),
        ]);
        session()->put('address', $newAddress);

        return back()->with('success_message', 'Ton adresse a bien été mise à jour!');
    
    }
}
