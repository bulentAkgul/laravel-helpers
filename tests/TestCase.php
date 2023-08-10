<?php

namespace Bakgul\LaravelHelpers\Tests;

use Bakgul\LaravelHelpers\Helpers\Str;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    protected function testBase(string $path = ''): string
    {
        return Str::append(__DIR__ . DIRECTORY_SEPARATOR . 'TestBase', $path);
    }
}
