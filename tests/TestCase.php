<?php

namespace Bakgul\LaravelHelpers\Tests;

use Bakgul\LaravelHelpers\Helpers\Str;
use Bakgul\LaravelDumpServer\Concerns\HasDumper;
use Bakgul\LaravelTestsToReadme\ToReadme;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use HasDumper;

    public function setUp(): void
    {
        parent::setUp();

        $this->resetDumper();
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
