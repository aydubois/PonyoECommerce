<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;
    
    
    /** @test */
    public function itworkTest(){
    
        $this->withoutExceptionHandling();
    
        $products = factory(Product::class, 3)->create();
        $this->get('/')
            ->assertSuccessful()
            ->assertViewIs('products.index')
            ->getViewData('products', $products);

    }
}
