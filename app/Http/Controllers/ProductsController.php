<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::paginate(9);
        return view('products.index', [
            'products'=> $products
        ]);
    }
    public function show($id){
        $product = Product::find($id);
        return view('products.show', [
            'product'=> $product
        ]);
    }
}
