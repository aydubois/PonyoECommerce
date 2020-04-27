<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /** @test 
     * Affichage du panier vide
    */
    function showEmptyCartTest(){
        // $this->withoutExceptionHandling(); //permet d'avoir les erreurs détaillées

        $this->get('/cart')
            ->assertSuccessful()
            ->assertViewHasEmptyCollection('productsWithQuantities'); //macro créée dans testCase
    }

    /** @test */
    function addProductTest(){

        $product = factory(Product::class)->create([
            'price_in_cents'=> 500,
        ]);
    
        $this->post('/cart', [
            'product_id' => $product->id,
        ])->assertRedirect();

        $response = $this->get('/cart')
            ->assertSuccessful();

        $productsWithQuantities = $response->getViewData('productsWithQuantities'); //macro créée dans TestCase

        $this->assertCount(1, $productsWithQuantities);
        $this->assertModelEquals($product, $productsWithQuantities->first()->product); 
        $this->assertEquals(1, $productsWithQuantities->first()->quantity); 
        $this->assertEquals(500, $productsWithQuantities->totalPriceInCents( )); 

    }

    /** @test */
    function add2Products(){

        $productA = factory(Product::class)->create();
        $productB = factory(Product::class)->create();

    
        $this->post('/cart', [
            'product_id' => $productA->id,
        ])->assertRedirect();
        $this->post('/cart', [
            'product_id' => $productB ->id,
        ])->assertRedirect();

        $response = $this->get('/cart')
            ->assertSuccessful();

        $productsWithQuantities = $response->getViewData('productsWithQuantities');

        $this->assertCount(2, $productsWithQuantities); 
        $this->assertModelEquals($productA, $productsWithQuantities[$productA->id]->product);
        $this->assertEquals(1, $productsWithQuantities[$productA->id]->quantity); 
        $this->assertModelEquals($productB, $productsWithQuantities[$productB->id]->product);
        $this->assertEquals(1, $productsWithQuantities[$productB->id]->quantity); 

    }

    /** @test */
    function addProductTwice(){

        $product = factory(Product::class)->create();

        $this->post('/cart', [
            'product_id' => $product->id,
        ])->assertRedirect();
        $this->post('/cart', [
            'product_id' => $product->id,
        ])->assertRedirect();

        $response = $this->get('/cart')
            ->assertSuccessful();

        $productsWithQuantities = $response->getViewData('productsWithQuantities');

        $this->assertCount(1, $productsWithQuantities); 
        $this->assertModelEquals($product, $productsWithQuantities->first()->product);
        $this->assertEquals(2, $productsWithQuantities->first()->quantity);

    }

        /** @test */
        function addProductWithQuantity(){

            $product = factory(Product::class)->create();
        
            $this->post('/cart', [
                'product_id' => $product->id,
                'quantity' => 3,
            ])->assertRedirect();
    
            $response = $this->get('/cart')
                ->assertSuccessful();

            $productsWithQuantities = $response->getViewData('productsWithQuantities');

            $this->assertCount(1, $productsWithQuantities); 
            $this->assertModelEquals($product, $productsWithQuantities->first()->product);
            $this->assertEquals(3, $productsWithQuantities->first()->quantity);
    

            $this->post('/cart', [
                'product_id' => $product->id,
                'quantity' => 9,
            ])->assertRedirect();
    
            $response = $this->get('/cart')
                ->assertSuccessful();

            $productsWithQuantities = $response->getViewData('productsWithQuantities');

            $this->assertCount(1, $productsWithQuantities); 
            $this->assertModelEquals($product, $productsWithQuantities->first()->product);
            $this->assertEquals(3+9 , $productsWithQuantities->first()->quantity);
        }

        /** @test */
        function addProductnotinDB(){ 
        
            $this->post('/cart', [
                'product_id' => 623,
                'quantity' => 3,
            ])->assertStatus(404 );
    
            $this->get('/cart')
                ->assertSuccessful()
                ->assertViewHasEmptyCollection ('productsWithQuantities');
        }

        /** @test */
        function addProductwithnotQuantityNumber(){
            $product = factory(Product::class)->create();

            $this->post('/cart', [
                'product_id' => $product->id,
                'quantity' => 'not-a-number',
            ])->assertSessionHasErrors('quantity');
    
            $this->get('/cart')
                ->assertSuccessful()
                ->assertViewHasEmptyCollection ('productsWithQuantities');
        }

        /** @test */
        function addProductwithQuantityNegative(){
            $product = factory(Product::class)->create();

            $this->post('/cart', [
                'product_id' => $product->id,
                'quantity' => -423,
            ])->assertSessionHasErrors('quantity');
            $this->post('/cart', [
                'product_id' => $product->id,
                'quantity' => 0,
            ])->assertSessionHasErrors('quantity');
    
            $this->get('/cart')
                ->assertSuccessful()
                ->assertViewHasEmptyCollection ('productsWithQuantities'); 
        }


        /** @test */
        function ModifyProductWithQuantity(){
            $this->withoutExceptionHandling(); 
    
            $product = factory(Product::class)->create();
    
        
            $this->post('/cart', [
                'product_id' => $product->id,
                'quantity' => 3,
            ])->assertRedirect();
            $this->patch('/cart', [
                'product_id' => $product->id,
                'quantity' => 5,
            ])->assertRedirect();
    
            $response = $this->get('/cart');
    
            $productsWithQuantities = $response->original->getData()['productsWithQuantities'];
            $this->assertEquals(1, $productsWithQuantities->count()); 
            $this->assertTrue($productsWithQuantities->first()->product->is($product));
            $this->assertEquals(5, $productsWithQuantities->first()->quantity);
            

        }

        /** @test */
        function ModifyProductnotinDB(){ 
        
            $this->patch('/cart', [
                'product_id' => 623,
                'quantity' => 3,
            ])->assertStatus(404 );
    
            $response = $this->get('/cart');
            $response->assertSuccessful()
            ->assertViewHas('productsWithQuantities', function($productsWithQuantities) {
                return $productsWithQuantities->isEmpty();
            });
        }

        /** @test */
        function ModifyProductwithoutQuantity(){
    
            $product = factory(Product::class)->create();
    
            $this->patch('/cart', [
                'product_id' => $product->id, 
            ])->assertSessionHasErrors('quantity');
    
            $response = $this->get('/cart');
    
            $productsWithQuantities = $response->original->getData()['productsWithQuantities'];
            $this->assertTrue($productsWithQuantities->isEmpty()); 
            
            
        }
        


        /** @test */
        function ModifyProductwithnotQuantityNumber(){
            $product = factory(Product::class)->create();

            $this->patch('/cart', [
                'product_id' => $product->id,
                'quantity' => 'not-a-number',
            ])->assertSessionHasErrors('quantity');
    
            $response = $this->get('/cart');
            $response->assertSuccessful()
            ->assertViewHas('productsWithQuantities', function($productsWithQuantities) {
                return $productsWithQuantities->isEmpty();
            });
        }

        /** @test */
        function ModifyProductwithQuantityNegative(){
            $product = factory(Product::class)->create();

            $this->patch('/cart', [
                'product_id' => $product->id,
                'quantity' => -423,
            ])->assertSessionHasErrors('quantity');
            $this->patch('/cart', [
                'product_id' => $product->id,
                'quantity' => 0,
            ])->assertSessionHasErrors('quantity');
    
            $response = $this->get('/cart');
            $response->assertSuccessful()
            ->assertViewHas('productsWithQuantities', function($productsWithQuantities) {
                return $productsWithQuantities->isEmpty();
            });
        }

        /** @test */
        function DeleteProduct(){
            $productA = factory(Product::class)->create();
            $productB = factory(Product::class)->create();


            $this->post('/cart', [
                'product_id' => $productA->id,
                'quantity' => 3,
            ])->assertRedirect();
            $this->post('/cart', [
                'product_id' => $productB->id,
                'quantity' => 6,
            ])->assertRedirect();
            $this->delete('/cart', [
                'product_id' => $productA->id,
            ])->assertRedirect();
    
            $response = $this->get('/cart');
            $productsWithQuantities = $response->original->getData()['productsWithQuantities'];
            $this->assertEquals(1, $productsWithQuantities->count()); 
            $this->assertTrue($productsWithQuantities->first()->product->is($productB));
    
        }
}
