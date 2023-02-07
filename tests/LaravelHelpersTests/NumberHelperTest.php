<?php

namespace Bakgul\LaravelHelpers\Tests\LaravelHelpersTests;

use Bakgul\LaravelHelpers\Helpers\Number;
use Bakgul\LaravelHelpers\Tests\TestCase;

class NumberHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Number::class,
            'test' => $this->getName(),
            ...$props
        ]);
    }

    /** @test */
    public function to_float_will_convert_a_number_to_a_float_based_on_percision(): void
    {
        $number = 1.125531;

        $this->toReadme([
            'method' => 'toFloat',
            'args' => [$number, 3],
        ]);

        $this->assertEquals(1.126, Number::toFloat($number, 3));
    }

    /** @test */
    public function to_int_will_convert_a_float_to_integer_by_multipleying_it_with_the_given_power_of_ten(): void
    {
        $number = 1.125531;

        $this->toReadme([
            'method' => 'toInt',
            'args' => [$number, 2],
        ]);

        $this->assertEquals(113, Number::toInt($number, 2));
    }
}
