<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiMailtrapTest extends TestCase
{

    /** @doesNotPerformAssertions */
    public function testBasicExample()
    {
        $response = $this->json('POST', '/user', ['name' => 'Sally']);
        $response
            ->assertStatus(201)
            ->assertExactJson([
                'created' => true,
            ]);
    }

}
