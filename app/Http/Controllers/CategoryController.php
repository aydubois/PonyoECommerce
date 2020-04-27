<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index($id = 1){

        $category = Category::find($id);
        $listingProductsCategory = Product::where('category_id', $category->id)->paginate(9);
        return view('categories.list_products', ['category'=> $category, 'listingProductsCategory'=>$listingProductsCategory]);
        
        // }else{
        //     return view('categories.error');
        // }
    }


    function listing(){
        $listin = Category::paginate(9);
        return view('categories.index', ['listin'=>$listin]);
    }
}
