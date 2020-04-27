<?php

namespace Tests\Feature;
 
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /** @test */
    function showHomepageTest(){
        $this->withoutExceptionHandling();
        $this->get('/')
            ->assertSuccessful()
            ->assertViewIs('homepage.index');
    }
}
