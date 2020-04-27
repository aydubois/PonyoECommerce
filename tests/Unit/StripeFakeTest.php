<?php

namespace Tests\Unit;

use App\Stripe1;
use App\StripeFake;
use Tests\Unit\StripeTest; 

class StripeFakeTest extends StripeTest
{
    public function setUp():void
    {
        parent::setUp();

        Stripe1::fake();

    }
}
