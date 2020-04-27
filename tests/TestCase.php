<?php

namespace Tests;

use PHPUnit\Framework\Assert;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    public function setUp():void
    {
        parent::setUp();

        //Definir une macro -> nouvelle fonction sur une classe Laravel
        TestResponse::macro('assertViewHasEmptyCollection', function($key){
            $collection = $this->getViewData($key);
            Assert::assertInstanceOf (Collection::class, $collection);
            Assert::assertEmpty($collection);

        });

        TestResponse::macro('getViewData', function($key){
            $this->assertViewHas($key);
            return $this->original->getData()[$key];
        });
    }

    protected function assertModelEquals($expected, $actual){

        $this->assertInstanceOf(Model::class, $actual);
        $this->assertInstanceOf(Model::class, $expected);
        $this->assertEquals(get_class($actual), get_class($expected));
        $this->assertTrue(
            $expected->is($actual),
            "Fail asserting Model #{$actual->id} is #{$expected->id}"
        ); 
    }
}
