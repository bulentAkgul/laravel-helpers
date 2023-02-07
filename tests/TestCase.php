<?php

namespace Bakgul\LaravelHelpers\Tests;

use Bakgul\LaravelHelpers\Helpers\Str;
use Bakgul\LaravelTestsToReadme\ToReadme;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (class_exists(\Spatie\LaravelRay\Ray::class)) ray()->clearAll();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
    protected function toReadme(array $props): void
    {
        (new ToReadme([
            'class' => Arr::class,
            'message' => '',
            ...$props
        ]))->write();
    }

    protected function testBase(string $path = ''): string
    {
        return Str::append(__DIR__ . '/TestBase', $path);
    }
}
