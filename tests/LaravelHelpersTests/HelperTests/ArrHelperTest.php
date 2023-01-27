<?php

namespace Bakgul\LaravelHelpers\Tests\LaravelHelpersTests\HelperTests;

use Bakgul\LaravelHelpers\Tests\TestCase;

class ArrHelperTest extends TestCase
{
    /** @test */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
