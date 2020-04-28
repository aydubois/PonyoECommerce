<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){

        $products = Product::inRandomOrder()->take(6)->get();
        return view('homepage.index')->with('products', $products);
    }
}
