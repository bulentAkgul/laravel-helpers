<?php

namespace Bakgul\LaravelHelpers\Tests\LaravelHelpersTests;

use Bakgul\LaravelHelpers\Helpers\Value;
use Bakgul\LaravelHelpers\Tests\TestCase;

class ValueHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Value::class,
            'test' => $this->getName(),
            ...$props
        ]);
    }
    /** @test */
    public function compare_will_compare_two_values_based_on_specified_operator(): void
    {
        $args = [1, 3, '<'];

        $this->toReadme([
            'method' => 'compare',
            'args' => $args
        ]);

        $this->assertTrue(Value::compare(...$args));
    }
}
