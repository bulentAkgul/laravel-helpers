<?php

namespace Bakgul\LaravelHelpers\Tests\LaravelHelpersTests;

use Bakgul\LaravelHelpers\Helpers\Pluralizer;
use Bakgul\LaravelHelpers\Tests\TestCase;

class PluralizerHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Pluralizer::class,
            'test' => $this->getName(),
            ...$props
        ]);
    }

    /** @test */
    public function make_will_run_pluralizer_after_setting_is_singular_when_the_second_arg_is_array(): void
    {
        $args = ['service', ['name_count' => 'P']];

        $this->toReadme([
            'method' => 'make',
            'args' => $args,
        ]);

        $this->assertEquals('services', Pluralizer::make(...$args));
    }

    /** @test */
    public function make_will_run_pluralizer_after_setting_is_singular(): void
    {
        $args = ['service', '', false];

        $this->toReadme([
            'method' => 'make',
            'args' => $args,
        ]);

        $this->assertEquals('services', Pluralizer::make(...$args));
    }

    /** @test */
    public function run_will_convert_str_to_plural_or_singular(): void
    {
        $args = ['models', null];

        $this->toReadme([
            'method' => 'run',
            'args' => $args,
        ]);

        $this->assertEquals('models', Pluralizer::run(...$args));
    }

    /** @test */
    public function set_will_make_is_singular_setting(): void
    {
        $args = [['count' => 'P'], 'count'];

        $this->toReadme([
            'method' => 'set',
            'args' => $args,
        ]);

        $this->assertFalse(Pluralizer::set(...$args));
    }
}
