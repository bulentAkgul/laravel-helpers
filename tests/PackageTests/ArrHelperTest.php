<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\Arr;
use Bakgul\LaravelHelpers\Tests\TestCase;

class ArrHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Arr::class,
            'test' => debug_backtrace()[1]['function'],
            ...$props
        ]);
    }

    /** @test */
    public function append_will_push_the_given_value_to_array_that_associated_to_given_key(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => [3, 4]];
        $args = ['c', 5];

        $this->toReadme([
            'method' => 'append',
            'args' => [$array, ...$args],
        ]);

        Arr::append($array, ...$args);

        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => [3, 4, 5]],
            $array
        );
    }

    /** @test */
    public function append_will_push_the_given_value_to_array_that_associated_to_given_key_using_dot_notation(): void
    {
        $array = ['a' => 1, 'b' => ['c' => [2, 3]]];
        $args = ['b.c', 4];

        $this->toReadme([
            'method' => 'append',
            'args' => [$array, ...$args],
        ]);

        Arr::append($array, ...$args);

        $this->assertEquals(
            ['a' => 1, 'b' => ['c' => [2, 3, 4]]],
            $array
        );
    }

    /** @test */
    public function carry_will_determine_if_the_array_has_the_key(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, 'b'];

        $this->toReadme([
            'method' => 'carry',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::carry(...$args));
    }

    /** @test */
    public function carry_will_determine_if_the_array_has_the_keys(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, ['b', 'c']];

        $this->toReadme([
            'method' => 'carry',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::carry(...$args));
    }

    /** @test */
    public function carry_will_determine_if_the_array_has_the_nested_key(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => ['e' => 3, 'f' => 4]]];
        $args = [$array, 'c.d.f'];

        $this->toReadme([
            'method' => 'carry',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::carry(...$args));
    }

    /** @test */
    public function carry_will_determine_if_the_array_has_the_value(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, 2, false];

        $this->toReadme([
            'method' => 'carry',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::carry(...$args));
    }

    /** @test */
    public function carry_will_determine_if_the_array_has_the_values(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, [2, 3], false];

        $this->toReadme([
            'method' => 'carry',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::carry(...$args));
    }

    /** @test */
    public function has_all_will_determine_if_all_terms_in_array_as_keys_by_using_dot_notation(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];
        $keys = ['a', 'c.d'];

        $this->toReadme([
            'method' => 'hasAll',
            'args' => [$array, $keys, true],
        ]);

        $this->assertTrue(Arr::hasAll($array, $keys, true));
    }

    /** @test */
    public function has_all_will_determine_if_all_terms_in_arrays_as_values(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];
        $keys = [1, 2];

        $this->toReadme([
            'method' => 'hasAll',
            'args' => [$array, $keys],
        ]);

        $this->assertTrue(Arr::hasAll($array, $keys));
    }

    /** @test */
    public function has_at_will_return_the_key_or_index_of_the_value_from_the_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, 2];

        $this->toReadme([
            'method' => 'hasAt',
            'args' => $args,
        ]);

        $this->assertEquals('b', Arr::hasAt(...$args));
    }

    /** @test */
    public function has_not_will_return_the_opposite_of_carry(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, 'd'];

        $this->toReadme([
            'method' => 'hasAt',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::hasNot(...$args));
    }

    /** @test */
    public function has_some_will_determine_if_some_of_the_searched_items_among_the_keys_of_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, ['a', 'd'], true];

        $this->toReadme([
            'method' => 'hasSome',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::hasSome(...$args));
    }

    /** @test */
    public function has_some_will_determine_if_some_of_the_searched_items_among_the_values_of_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, [2, 5]];

        $this->toReadme([
            'method' => 'hasSome',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::hasSome(...$args));
    }

    /** @test */
    public function has_none_will_return_the_opposite_of_has_some(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $args = [$array, [4, 5]];

        $this->toReadme([
            'method' => 'hasNone',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::hasNone(...$args));
    }

    /** @test */
    public function combine_will_generate_key_value_pairs_from_two_arrays(): void
    {
        $keys = ['a', 'b', 'c'];
        $values = [1, 2, 3];

        $this->toReadme([
            'method' => 'combine',
            'args' => [$keys, $values],
        ]);

        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3],
            Arr::combine($keys, $values)
        );
    }

    /** @test */
    public function combine_will_generate_key_value_pairs_from_two_arrays_by_filling_missing_values(): void
    {
        $keys = ['a', 'b', 'c'];
        $values = [1, 2];
        $default = 'x';

        $this->toReadme([
            'method' => 'combine',
            'args' => [$keys, $values, $default],
        ]);

        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => $default],
            Arr::combine($keys, $values, $default)
        );
    }

    /** @test */
    public function combine_will_generate_key_value_pairs_from_two_arrays_by_removing_extra_values(): void
    {
        $keys = ['a', 'b'];
        $values = [1, 2, 3];

        $this->toReadme([
            'method' => 'combine',
            'args' => [$keys, $values],
        ]);

        $this->assertEquals(
            ['a' => 1, 'b' => 2],
            Arr::combine($keys, $values)
        );
    }

    /** @test */
    public function contains_will_determine_if_the_given_value_is_a_part_of_the_array(): void
    {
        $array = ['apple', 'banana', 'orange'];
        $search = 'nana';

        $this->toReadme([
            'method' => 'contains',
            'args' => [$array, $search],
        ]);

        $this->assertTrue(Arr::contains($array, $search));
    }

    /** @test */
    public function contains_at_will_return_the_index_or_key_of_item_that_contains_the_searched_term(): void
    {
        $array = ['apple', 'banana', 'orange'];
        $search = 'nana';

        $this->toReadme([
            'method' => 'containsAt',
            'args' => [$array, $search],
        ]);

        $this->assertEquals(1, Arr::containsAt($array, $search));
    }

    /** @test */
    public function contains_on_will_return_the_item_that_contains_the_searched_term(): void
    {
        $array = ['apple', 'banana', 'orange'];
        $search = 'nana';

        $this->toReadme([
            'method' => 'containsOn',
            'args' => [$array, $search],
        ]);

        $this->assertEquals('banana', Arr::containsOn($array, $search));
    }

    /** @test */
    public function delete_will_remove_the_specified_key_from_the_array_and_return_the_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];
        $key = 'a';

        $this->toReadme([
            'method' => 'delete',
            'args' => [$array, $key],
        ]);

        $this->assertEquals(
            ['b' => 2, 'c' => ['d' => 3, 'e' => 4]],
            Arr::delete($array, $key)
        );
    }

    /** @test */
    public function delete_will_remove_the_specified_key_using_dot_notation_from_the_array_and_return_the_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];
        $keys = ['a', 'c.d'];

        $this->toReadme([
            'method' => 'delete',
            'args' => [$array, $keys],
        ]);

        $this->assertEquals(
            ['b' => 2, 'c' => ['e' => 4]],
            Arr::delete($array, $keys)
        );
    }

    /** @test */
    public function drop_will_remove_the_specified_key_using_dot_notation_from_the_referenced_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];
        $keys = 'a';

        $this->toReadme([
            'method' => 'drop',
            'args' => [$array, $keys],
            'result' => 'void'
        ]);

        Arr::drop($array, $keys);

        $this->assertEquals(['b' => 2, 'c' => ['d' => 3, 'e' => 4]], $array);
    }

    /** @test */
    public function find_will_return_the_key_and_value_of_the_first_matched_item(): void
    {
        $array = [
            ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]],
            ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]],
        ];

        $this->toReadme([
            'method' => 'find',
            'args' => [$array, 5, 'a'],
        ]);

        $this->assertEquals(
            ['key' => 1, 'value' => ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]],
            Arr::find($array, 5, 'a')
        );
    }

    /** @test */
    public function find_can_use_dot_notation_as_searched_key_and_different_comparison_oprators(): void
    {
        $array = [
            ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]],
            ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]],
        ];

        $this->toReadme([
            'method' => 'find',
            'args' => [$array, 5, 'c.d', '<'],
        ]);

        $this->assertEquals(
            ['key' => 0, 'value' => ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]]],
            Arr::find($array, 5, 'c.d', '<')
        );
    }

    /** @test */
    public function first_key_will_return_the_key_of_what_find_method_returns(): void
    {
        $array = [
            ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]],
            ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]],
        ];

        $this->toReadme([
            'method' => 'firstKey',
            'args' => [$array, 5, 'a'],
        ]);

        $this->assertEquals(1, Arr::firstKey($array, 5, 'a'));
    }

    /** @test */
    public function first_value_will_return_the_value_of_what_find_method_returns(): void
    {
        $array = [
            ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]],
            ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]],
        ];

        $this->toReadme([
            'method' => 'firstValue',
            'args' => [$array, 5, 'b', ''],
        ]);

        $this->assertEquals(
            ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]],
            Arr::firstValue($array, 2, 'b', '!=')
        );
    }

    /** @test */
    public function fetch_will_return_an_item_that_is_associated_to_given_key_from_the_array(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];

        $this->toReadme([
            'method' => 'fetch',
            'args' => [$array, 'a'],
        ]);

        $this->assertEquals(1, Arr::fetch($array, 'a'));
    }

    /** @test */
    public function fetch_can_return_multiple_vales_with_multiple_keys(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];

        $this->toReadme([
            'method' => 'fetch',
            'args' => [$array, ['a', 'b']],
        ]);

        $this->assertEquals(
            ['a' => 1, 'b' => 2],
            Arr::fetch($array, ['a', 'b'])
        );
    }

    /** @test */
    public function fetch_will_return_the_first_value_when_the_key_is_zero(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];

        $this->toReadme([
            'method' => 'fetch',
            'args' => [$array, 0],
        ]);

        $this->assertEquals(1, Arr::fetch($array, 0));
    }

    /** @test */
    public function fetch_will_return_the_last_value_when_the_key_is_opposite_one(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]];

        $this->toReadme([
            'method' => 'fetch',
            'args' => [$array, -1],
        ]);

        $this->assertEquals(['d' => 3, 'e' => 4], Arr::fetch($array, -1));
    }

    /** @test */
    public function group_will_create_a_groupped_array_of_given_key(): void
    {
        $array = [
            ['city' => 'Istanbul', 'name' => 'Bulent'],
            ['city' => 'Istanbul', 'name' => 'Ozan'],
            ['city' => 'Istanbul', 'name' => 'Elif'],
            ['city' => 'Istanbul', 'name' => 'Sibel'],
            ['city' => 'Ankara', 'name' => 'Sinan'],
            ['city' => 'Ankara', 'name' => 'Burak'],
            ['city' => 'Ankara', 'name' => 'Canan'],
            ['city' => 'Ankara', 'name' => 'Hilal'],
        ];

        $keys = 'city';

        $this->toReadme([
            'method' => 'group',
            'args' => [$array, $keys],
        ]);

        $this->assertEquals(
            [
                'Istanbul' => [
                    ['city' => 'Istanbul', 'name' => 'Bulent'],
                    ['city' => 'Istanbul', 'name' => 'Ozan'],
                    ['city' => 'Istanbul', 'name' => 'Elif'],
                    ['city' => 'Istanbul', 'name' => 'Sibel'],
                ],
                'Ankara' => [
                    ['city' => 'Ankara', 'name' => 'Sinan'],
                    ['city' => 'Ankara', 'name' => 'Burak'],
                    ['city' => 'Ankara', 'name' => 'Canan'],
                    ['city' => 'Ankara', 'name' => 'Hilal'],
                ],
            ],
            Arr::group($array, $keys)
        );
    }

    /** @test */
    public function group_will_create_a_nested_array_based_on_given_keys(): void
    {
        $array = [
            ['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Bulent'],
            ['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Ozan'],
            ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Elif'],
            ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Sibel'],
            ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Sinan'],
            ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Burak'],
            ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Canan'],
            ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Hilal'],
        ];

        $keys = ['city', 'gender'];

        $this->toReadme([
            'method' => 'group',
            'args' => [$array, $keys],
        ]);

        $this->assertEquals(
            [
                'Istanbul' => [
                    'male' => [
                        ['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Bulent'],
                        ['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Ozan'],
                    ],
                    'female' => [
                        ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Elif'],
                        ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Sibel'],
                    ],
                ],
                'Ankara' => [
                    'male' => [
                        ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Sinan'],
                        ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Burak'],
                    ],
                    'female' => [
                        ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Canan'],
                        ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Hilal'],
                    ],
                ],
            ],
            Arr::group($array, $keys)
        );
    }

    /** @test */
    public function in_will_determine_if_the_searched_item_among_the_array_values(): void
    {
        $args = [[1, 2, 3], 2];

        $this->toReadme([
            'method' => 'in',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::in(...$args));
    }

    /** @test */
    public function in_will_determine_if_the_searched_items_among_the_array_values(): void
    {
        $args = [['a' => 1, 'b' => 2, 'c' => 3], [2, 3]];

        $this->toReadme([
            'method' => 'in',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::in(...$args));
    }

    /** @test */
    public function out_will_return_the_opposite_of_in(): void
    {
        $args = [[1, 2, 3], 4];

        $this->toReadme([
            'method' => 'out',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::out(...$args));
    }

    /** @test */
    public function is_equal_will_determine_if_the_given_two_arrays_are_equal_based_on_all_of_the_given_keys(): void
    {
        $args = [
            ['a' => 1, 'b' => 2, 'c' => 3],
            ['a' => 1, 'b' => 2, 'c' => 4],
            ['a', 'b']
        ];

        $this->toReadme([
            'method' => 'isEqual',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::isEqual(...$args));
    }

    /** @test */
    public function is_equal_will_determine_if_the_given_two_arrays_are_equal_based_on_the_equality_of_at_least_one_of_the_given_keys(): void
    {
        $args = [
            ['a' => 1, 'b' => 2, 'c' => 3],
            ['a' => 1, 'b' => 2, 'c' => 4],
            ['a', 'c'],
            'or'
        ];

        $this->toReadme([
            'method' => 'isEqual',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::isEqual(...$args));
    }

    /** @test */
    public function is_not_equal_will_return_the_opposite_of_is_equal(): void
    {
        $args = [
            ['a' => 1, 'b' => 2, 'c' => 3],
            ['a' => 1, 'b' => 2, 'c' => 4],
            ['a', 'c']
        ];

        $this->toReadme([
            'method' => 'isNotEqual',
            'args' => $args,
        ]);

        $this->assertTrue(Arr::isNotEqual(...$args));
    }

    /** @test */
    public function map_assoc_will_perform_a_map_action_with_given_callback()
    {
        $args = [
            ['a' => 1, 'b' => 2, 'c' => 3],
            fn ($k, $v) => "{$k}-$v"
        ];

        $this->toReadme([
            'method' => 'mapAssoc',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['a' => 'a-1', 'b' => 'b-2', 'c' => 'c-3'],
            Arr::mapAssoc(...$args)
        );
    }

    /** @test */
    public function map_assoc_will_perform_a_map_action_with_given_callback_and_combine_results_with_the_given_keys()
    {
        $args = [
            ['a' => 1, 'b' => 2, 'c' => 3],
            fn ($k, $v) => "{$k}-$v",
            ['x', 'y', 'z']
        ];

        $this->toReadme([
            'method' => 'mapAssoc',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['x' => 'a-1', 'y' => 'b-2', 'z' => 'c-3'],
            Arr::mapAssoc(...$args)
        );
    }

    /** @test */
    public function order_will_sort_the_list_by_using_sort_or_rsort()
    {
        $array = [3, 5, 6, 4, 2, 7];

        $args = [$array, true];

        $this->toReadme([
            'test' => 'order_will_sort_the_list_by_using_sort',
            'method' => 'order',
            'args' => $args,
        ]);

        $this->assertEquals([2, 3, 4, 5, 6, 7], Arr::order(...$args));

        $args = [$array, false];

        $this->toReadme([
            'test' => 'order_will_sort_the_list_by_using_rsort',
            'method' => 'order',
            'args' => $args,
        ]);

        $this->assertEquals([7, 6, 5, 4, 3, 2], Arr::order(...$args));
    }

    /** @test */
    public function order_will_sort_the_assosiative_array_with_keys_via_ksort_or_krsort()
    {
        $array = ['b' => 2, 'd' => 4, 'c' => 3, 'a' => 1];

        $args = [$array, true];

        $this->toReadme([
            'test' => 'order_will_sort_the_associative_array_based_on_its_keys_by_using_ksort',
            'method' => 'order',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
            Arr::order(...$args)
        );

        $args = [$array, false];

        $this->toReadme([
            'test' => 'order_will_sort_the_associative_array_based_on_its_keys_by_using_krsort',
            'method' => 'order',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['d' => 4, 'c' => 3, 'b' => 2, 'a' => 1],
            Arr::order(...$args)
        );
    }

    /** @test */
    public function order_will_sort_the_assosiative_array_by_the_callback_via_uasort_or_uksort()
    {
        $array = ['b' => 3, 'd' => 1, 'c' => 2, 'a' => 4];
        $callback = fn ($a, $b) => $a <=> $b;

        $args = [$array, true, $callback];

        $this->toReadme([
            'test' => 'order_will_sort_the_associative_array_based_on_the_callback_by_using_uasort',
            'method' => 'order',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['a' => 4, 'b' => 3, 'c' => 2, 'd' => 1],
            Arr::order(...$args)
        );

        $args = [$array, false, $callback];

        $this->toReadme([
            'test' => 'order_will_sort_the_associative_array_based_on_the_callback_by_using_uksort',
            'method' => 'order',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['d' => 1, 'c' => 2, 'b' => 3, 'a' => 4],
            Arr::order(...$args)
        );
    }

    /** @test */
    public function order_will_sort_the_list_by_callback_via_usort()
    {
        $array = ['bbb', 'eeee', 'cc', 'd', 'aaaaa'];
        $callback = fn ($a, $b) => strlen($a) <=> strlen($b);

        $this->toReadme([
            'message' => 'The second argument has no effect on this execution.',
            'method' => 'order',
            'args' => [$array, true, $callback]
        ]);

        $this->assertEquals(
            ['d', 'cc', 'bbb', 'eeee', 'aaaaa'],
            Arr::order($array, callback: $callback)
        );
    }

    /** @test */
    public function rand_will_return_a_randomly_selected_item_from_array(): void
    {
        $args = [[1, 2, 3, 4, 5], 1];

        $this->toReadme([
            'method' => 'rand',
            'args' => $args
        ]);

        $result = Arr::rand(...$args);

        $this->assertTrue(is_int($result) && in_array($result, $args[0]));
    }

    /** @test */
    public function rand_will_return_a_list_of_randomly_selected_items_from_array(): void
    {
        $args = [[1, 2, 3, 4, 5], 3];

        $this->toReadme([
            'method' => 'rand',
            'args' => $args
        ]);

        $result = Arr::rand(...$args);

        $this->assertTrue(
            is_array($result) && count($result) <= $args[1] && Arr::hasAll($args[0], (array) $args[1])
        );
    }

    /** @test */
    public function range_will_create_an_arrat_from_min_to_a_value_between_min_and_max(): void
    {
        $args = [10, 2];

        $this->toReadme([
            'method' => 'range',
            'args' => $args
        ]);

        $result = Arr::range(...$args);

        $this->assertTrue($result[0] == $args[1] && Arr::last($result) <= $args[0]);
    }

    /** @test */
    public function resolve_will_return_truety_values_with_resetted_index(): void
    {
        $array = [0, 1, 2, 3, '', 4, null, 5];

        $this->toReadme([
            'method' => 'resolve',
            'args' => [$array]
        ]);

        $this->assertEquals([1, 2, 3, 4, 5], Arr::resolve($array));
    }

    /** @test */
    public function select_will_return_the_specified_keys_and_their_values_from_array_by_setting_missing_values_default(): void
    {
        $args = [
            ['a' => 1, 'b' => 2, 'c' => 3],
            ['a', 'd'],
            'x'
        ];

        $this->toReadme([
            'method' => 'select',
            'args' => $args
        ]);

        $this->assertEquals(
            ['a' => 1, 'd' => $args[2]],
            Arr::select(...$args)
        );
    }

    /** @test */
    public function splice_will_execute_array_splice_and_return_the_array(): void
    {
        $args = [[1, 2, 3, 4, 5], 1, 3, ['a', 'b']];

        $this->toReadme([
            'method' => 'splice',
            'args' => $args
        ]);

        $this->assertEquals([1, 'a', 'b', 5], Arr::splice(...$args));
    }

    /** @test */
    public function prioritize_will_bring_to_front_the_specified_items_and_then_list_rest(): void
    {
        $args = [[1, 2, 3, 4, 5], [2, 4]];

        $this->toReadme([
            'method' => 'prioritize',
            'args' => $args
        ]);

        $this->assertEquals([2, 4, 1, 3, 5], array_values(Arr::prioritize(...$args)));
    }

    /** @test */
    public function unique_will_return_unique_values_after_resetting_indexes(): void
    {
        $array = [1, 2, 2, 3, 4, 5, 5];

        $this->toReadme([
            'method' => 'unique',
            'args' => [$array]
        ]);

        $this->assertEquals([1, 2, 3, 4, 5], Arr::unique($array));
    }

    /** @test */
    public function value_will_return_the_value_of_the_found_item_in_array(): void
    {
        $array = [
            ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]],
            ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]],
        ];

        $args = [$array, 5, 'a', '=', 'c'];

        $this->toReadme([
            'method' => 'value',
            'args' => $args,
        ]);

        $this->assertEquals(
            ['d' => 7, 'e' => 8],
            Arr::value(...$args)
        );
    }
}
