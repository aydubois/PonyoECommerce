<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductWithQuantity extends Model{

    protected $guarded = [];
    protected $table = 'products_with_quantities';

    public static function  fromProductAndQuantity($product, $quantity){

        $productWithQuantity = new self([
            'product_id' => $product->id,
            'quantity' => $quantity,
            
        ]); 
        
        $productWithQuantity->setRelation('product', $product);
        return $productWithQuantity;
    }

    /** Mise en place de la relation product - productwithquantity  */
    public function articles(){
        return $this->belongsTo(Product::class);
    }

    public function getTotalPriceInCentsAttribute(){
        return $this->quantity * $this->product->price_in_cents;

    }
}