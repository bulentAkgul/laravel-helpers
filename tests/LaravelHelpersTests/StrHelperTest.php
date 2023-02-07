<?php

namespace Bakgul\LaravelHelpers\Tests\LaravelHelpersTests;

use Bakgul\LaravelHelpers\Helpers\Str;
use Bakgul\LaravelHelpers\Tests\TestCase;

class StrHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Str::class,
            'test' => $this->getName(),
            ...$props
        ]);
    }

    /** @test */
    public function append_will_add_str_to_base_with_glue_unless_str_is_empty(): void
    {
        $args = ['base', 'str', '-'];

        $this->toReadme([
            'method' => 'append',
            'args' => $args,
        ]);

        $this->assertEquals('base-str', Str::append(...$args));
    }

    /** @test */
    public function prepend_will_add_str_to_beginning_of_base_with_glue_unless_str_is_empty(): void
    {
        $args = ['base', 'str', '-'];

        $this->toReadme([
            'method' => 'prepend',
            'args' => $args,
        ]);

        $this->assertEquals('str-base', Str::prepend(...$args));
    }

    /** @test */
    public function inject_will_wrap_the_string_with_specified_characters(): void
    {
        $args = ['str', ['[', '(', '<', 'sq']];

        $this->toReadme([
            'method' => 'inject',
            'args' => $args,
        ]);

        $this->assertEquals("[(<'str'>)]", Str::inject(...$args));
    }

    /** @test */
    public function enclose_will_wrap_str_with_the_given_character(): void
    {
        $args = ['str', '{'];

        $this->toReadme([
            'method' => 'enclose',
            'args' => $args,
        ]);

        $this->assertEquals("{str}", Str::enclose(...$args));
    }

    /** @test */
    public function compare_will_determine_if_two_strings_are_equal(): void
    {
        $args = ['one', 'one', '=='];

        $this->toReadme([
            'method' => 'compare',
            'args' => $args,
        ]);

        $this->assertTrue(Str::compare(...$args));
    }

    /** @test */
    public function compare_will_determine_if_the_first_string_contains_the_second_one(): void
    {
        $args = ['one', 'n', '='];

        $this->toReadme([
            'method' => 'compare',
            'args' => $args,
        ]);

        $this->assertTrue(Str::compare(...$args));
    }

    /** @test */
    public function has_will_determine_if_the_string_contains_the_searhed_term(): void
    {
        $args = ['searchable str', 'search', false];

        $this->toReadme([
            'method' => 'has',
            'args' => $args,
        ]);

        $this->assertTrue(Str::has(...$args));
    }

    /** @test */
    public function has_not_returns_the_opposite_of_has(): void
    {
        $args = ['searchable str', 'search', false];

        $this->toReadme([
            'method' => 'hasNot',
            'args' => $args,
        ]);

        $this->assertFalse(Str::hasNot(...$args));
    }

    /** @test */
    public function has_will_determine_if_the_string_has_the_searced_word(): void
    {
        $args = ['searchable str', 'search', true];

        $this->toReadme([
            'method' => 'has',
            'args' => $args,
        ]);

        $this->assertFalse(Str::has(...$args));
    }

    /** @test */
    public function has_some_will_determine_if_the_string_has_at_least_one_of_the_given_substrings(): void
    {
        $args = ['searchable str', ['word', 'str']];

        $this->toReadme([
            'method' => 'hasSome',
            'args' => $args,
        ]);

        $this->assertTrue(Str::hasSome(...$args));
    }

    /** @test */
    public function has_none_will_return_the_opposite_of_has_some(): void
    {
        $args = ['searchable str', ['word', 'str']];

        $this->toReadme([
            'method' => 'hasNone',
            'args' => $args,
        ]);

        $this->assertFalse(Str::hasNone(...$args));
    }

    /** @test */
    public function has_all_will_determine_if_the_all_substrings_are_in_the_string(): void
    {
        $args = ['searchable str', ['search', 'str'], true];

        $this->toReadme([
            'method' => 'hasAll',
            'args' => $args,
        ]);

        $this->assertFalse(Str::hasAll(...$args));
    }

    /** @test */
    public function get_tail_will_return_the_last_part_of_string_in_the_given_length(): void
    {
        $args = ['one two three four five', ' ', 2];

        $this->toReadme([
            'method' => 'getTail',
            'args' => $args
        ]);

        $this->assertEquals('four five', Str::getTail(...$args));
    }

    /** @test */
    public function drop_tail_will_remove_the_last_part_of_the_string_in__the_given_length(): void
    {
        $args = ['one/two/three/four/five', '/', 3];

        $this->toReadme([
            'method' => 'dropTail',
            'args' => $args
        ]);

        $this->assertEquals('one/two', Str::dropTail(...$args));
    }

    /** @test */
    public function change_tail_will_replace_the_last_part_of_the_string_with_the_given_string(): void
    {
        $args = ['one.two.three.four.five', '5', '.', 2];

        $this->toReadme([
            'method' => 'changeTail',
            'args' => $args
        ]);

        $this->assertEquals('one.two.three.5', Str::changeTail(...$args));
    }

    /** @test */
    public function separate_tail_will_divide_string_two_parts_based_on_glue_and_length(): void
    {
        $args = ['one_two_three_four_five', '_', 2];

        $this->toReadme([
            'method' => 'separateTail',
            'args' => $args
        ]);

        $this->assertEquals(['one_two_three', 'four_five'], Str::separateTail(...$args));
    }

    /** @test */
    public function trim_will_trim_string_with_give_characters_and_default_ones(): void
    {
        $args = [' * one two three.', '*.', true];

        $this->toReadme([
            'method' => 'trim',
            'args' => $args
        ]);

        $this->assertEquals('one two three', Str::trim(...$args));
    }

    /** @test */
    public function format_will_apply_formatter_method_to_each_string_in_array(): void
    {
        $args = ['ucfirst', ['one', 'two', 'three']];

        $this->toReadme([
            'method' => 'format',
            'args' => $args
        ]);

        $this->assertEquals(['One', 'Two', 'Three'], Str::format(...$args));
    }

    /** @test */
    public function format_will_apply_formatter_to_each_word_in_string_based_on_glue(): void
    {
        $args = ['ucfirst', 'one_two-three.four', '-'];

        $this->toReadme([
            'method' => 'format',
            'args' => $args
        ]);

        $this->assertEquals(['One_two', 'Three.four'], Str::format(...$args));
    }
}
