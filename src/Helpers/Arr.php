<?php

namespace Bakgul\LaravelHelpers\Helpers;

use Illuminate\Support\Arr as BaseArray;

class Arr extends BaseArray
{
    /**
     * It pushes the item to the array by usign dot notation
     * 
     * @param array &$array
     * @param string|int $keys
     * @param mixed $value
     * @return void
     */
    public static function append(array &$array, string|int $keys, mixed $value): void
    {
        if (self::hasNot($array, $keys)) {
            parent::set($array, $keys, []);
        }

        $target = self::get($array, $keys);

        if (is_array($target)) $target[] = $value;

        parent::set($array, $keys, $target);
    }

    /**
     * It determines if the searched string is in the array as keys or values. 
     *
     * @param array $array
     * @param mixed $search
     * @param bool $isKey
     * 
     * @return boolean
     */
    public static function carry(array $array, mixed $search, bool $isKey = true): bool
    {
        return $isKey ? parent::has($array, $search) : self::in($array, $search);
    }

    /**
     * It checkes if the array has all of the searched items on keys or values or both.
     * 
     * @param array $array
     * @param array $search
     * @param bool $isKey
     * 
     * @return bool
     */
    public static function hasAll(array $array, array $search, bool $isKey = false): bool
    {
        return array_reduce(
            array_map(fn ($x) => self::carry($array, $x, $isKey), $search),
            fn ($previous, $current) => $previous && $current,
            true
        );
    }

    /**
     * It finds the key of the items that is equals to seached value.
     * 
     * @param array $array
     * @param mixed $search
     * 
     * @return int|string
     */
    public static function hasAt(array $array, mixed $search): int|string|null
    {
        foreach ($array as $key => $item) {
            if ($item == $search) return $key;
        }

        return null;
    }

    /**
     * It returns the opposite of "carry".
     * 
     * @param array $array
     * @param string $search
     * @param bool $isKey
     * 
     * @return bool
     */
    public static function hasNot(array $array, string $search, bool $isKey = true): bool
    {
        return !self::carry($array, $search, $isKey);
    }

    /**
     * It determines if any of the searched terms in array's keys or values.
     * 
     * @param array $array
     * @param array $search
     * @param bool $isKey
     * 
     * @return bool
     */
    public static function hasSome(array $array, array $search, bool $isKey = false): bool
    {
        return array_reduce(
            array_map(fn ($x) => self::carry($array, $x, $isKey), $search),
            fn ($previous, $current) => $previous || $current,
            false
        );
    }

    /**
     * It returns opposite of hasSome
     * 
     * @param array $array
     * @param array $search
     * @param bool $isKey
     * @return bool
     */
    public static function hasNone(array $array, array $search, bool $isKey = false): bool
    {
        return !self::hasSome($array, $search, $isKey);
    }

    /**
     * It combines 2 arrays as key => value by removing extra
     * values or filling the missing values with default one.
     * 
     * @param array $keys
     * @param array $values
     * @param mixed $default
     * 
     * @return array
     */
    public static function combine(array $keys, array $values = [], $default = null)
    {
        $diff = count($keys) - count($values);

        $values = match (true) {
            $diff > 0 => [...$values, ...array_fill(0, $diff, $default)],
            $diff < 0 => array_slice($values, 0, count($keys)),
            default => $values
        };

        return array_combine($keys, $values);
    }

    /**
     * It checks if given string is in the array by using str_contains
     * 
     * @param array $array
     * @param string $search
     * 
     * @return bool
     */
    public static function contains(array $array, string $search): bool
    {
        return self::containsAt($array, $search) !== null;
    }

    /**
     * It find and returns the key of item that contains the given string.
     * 
     * @param array $array
     * @param string $search
     * 
     * @return int|null
     */
    public static function containsAt(array $array, string $search): ?int
    {
        if (!$array || !$search) return null;

        foreach ($array as $i => $item) {
            if (str_contains($item, $search)) return $i;
        }

        return null;
    }

    /**
     * It returns the item that contains the given string.
     * 
     * @param array $array
     * @param string $search
     * 
     * @return string
     */
    public static function containsOn(array $array, string $search): string
    {
        $i = self::containsAt($array, $search);

        return $i !== null ? $array[$i] : '';
    }

    /**
     * It deletes the key - value pair in array and returns the array.
     * keys = 0 deletes the first item.
     * keys = -1 deletes the last item.
     * keys = string uses dot notation.
     * 
     * @param array $array 
     * @param array|int|float|string $keys
     * 
     * @return array
     */
    public static function delete(array $array, array|int|float|string $keys = -1): array
    {
        match ($keys) {
            -1 => array_pop($array),
            0 => array_shift($array),
            default => parent::forget($array, $keys)
        };

        return $array;
    }

    /**
     * It will remove the key from the referenced array
     * @param mixed &$array
     * @param array|int|float|string $keys
     * @return void
     */
    public static function drop(&$array, array|int|float|string $keys = -1): void
    {
        $array = Arr::delete($array, $keys);
    }

    /**
     * It returns an item from the array based on keys value.
     * keys = 0 returns the first item or default value if array is empty.
     * keys = -1 returns the last item or default value if array is empty.
     * keys = string uses dot notation.
     * 
     * @param array $array
     * @param array|string|int $keys
     * @param mixed $default
     * 
     * @return mixed
     */
    public static function fetch(array $array, array|string|int $keys = '', mixed $default = null)
    {
        return match (true) {
            $keys == 0 => array_shift($array) ?? $default,
            $keys == -1 => array_pop($array) ?? $default,
            is_array($keys) => self::select($array, $keys, $default),
            default => parent::get($array, $keys, $default)
        };
    }

    /**
     * It finds the searched item in array and returns it like
     * [key => the key of the found value, value => the found value]
     * If nothing has found, it returns [key => null, value => null]
     * or null depends on $nullable.
     *
     * @param array $array
     * @param array|int|float|string $search
     * @param string $keys
     * @param string $operator
     * @param bool $nullable
     * 
     * @return array|null
     */
    public static function find(
        array $array,
        array|int|float|string $search,
        string $keys = '',
        string $operator = '=',
        bool $nullable = true,
    ): ?array {
        $segments = array_filter(explode('.', $keys));

        foreach ($array as $key => $value) {
            $newValue = $value;

            foreach ($segments as $segment) {
                if (is_array($newValue) && self::carry($newValue, $segment)) {
                    $newValue = $newValue[$segment];
                } else {
                    continue;
                }
            }

            if (
                $newValue == $value &&
                gettype($newValue) == 'array' &&
                self::hasNot($newValue, $segment)
            ) continue;

            $type = gettype($newValue);

            foreach ((array) $search as $term) {
                if (match (true) {
                    $type == 'array' => is_array($term) ? $newValue == $term : in_array($term, $newValue),
                    Number::is($type) => Value::compare($newValue, $term, $operator),
                    $type == 'string' => Str::compare($newValue, $term, $operator),
                    default => false
                }) {
                    return [
                        'key' => $key,
                        'value' => $segments ? $array[$key] : $newValue
                    ];
                }
            }
        }

        return $nullable ? null : ['key' => null, 'value' => null];
    }

    /**
     * It will return the key of what self::find() returns
     *
     * @param array $array
     * @param array|int|float|string $search
     * @param string $keys
     * @param string $operator
     * @return int|string|null
     */

    public static function firstKey(
        array $array,
        array|int|float|string $search,
        string $keys = '',
        string $operator = '=',
    ): int|string|null {
        return self::find($array, $search, $keys, $operator, false)['key'];
    }

    /**
     * It will return the value of what self::find() returns
     *
     * @param array $array
     * @param array|int|float|string $search
     * @param string $keys
     * @param string $operator
     * @return string|null
     */
    public static function firstValue(
        array $array,
        array|int|float|string $search,
        string $keys = '',
        string $operator = '=',
    ): mixed {
        return self::find($array, $search, $keys, $operator, false)['value'];
    }

    /**
     * It groups the items in array by the values of the given keys.
     * 
     * @param array $array
     * @param array|int|string $keys
     * 
     * @return array
     */
    public static function group(array $array, array|int|string $keys): array
    {
        $group = [];

        $keys = (array) $keys;
        $key = array_shift($keys);

        foreach ($array as $value) {
            $group[parent::get($value, $key)][] = $value;
        }

        if (empty($keys)) return $group;

        foreach ($group as $key => $list) {
            $group[$key] = self::group($list, $keys);
        }

        return $group;
    }

    /**
     * It determines if the seached terms are in the array.
     * 
     * @param array $array
     * @param mixed $search
     * 
     * @return bool
     */
    public static function in(array $array, mixed $search): bool
    {
        return is_array($search)
            ? self::hasAll($array, $search, false)
            : in_array($search, array_values($array));
    }

    /**
     * It returns the opposite of Arr::in().
     * 
     * @param array $array
     * @param string $search
     * 
     * @return bool
     */
    public static function out(array $array, string $search): bool
    {
        return !self::in($array, $search);
    }

    /**
     * It checks if two arrays are equal in terms of the given keys.
     * 
     * @param array $src
     * @param array $check
     * @param array $keys
     * @param string $mode
     * 
     * @return bool
     */
    public static function isEqual(array $src, array $check, array $keys, string $mode = 'and'): bool
    {
        return array_reduce(
            $keys,
            fn ($p, $c) => $mode == 'and'
                ? $p && $src[$c] == $check[$c]
                : $p || $src[$c] == $check[$c],
            $mode == 'and'
        );
    }

    public static function isNotEqual(array $src, array $check, array $keys, string $mode = 'and'): bool
    {
        return !self::isEqual($src,  $check,  $keys,  $mode);
    }

    /**
     * It execute a map action with given callback on an associative array
     * while it can assign the values to a new set of keys.
     * 
     * @param array $array
     * @param callable|null $callback
     * @param array $keys
     * 
     * @return array
     */
    public static function mapAssoc(array $array, callable $callback = null, array $keys = [])
    {
        return array_combine($keys ?: array_keys($array), array_map($callback, array_keys($array), $array));
    }

    /**
     * It sorts a list or associative array by value or keys by using
     * uasort, uksort, usort, ksort, krsort, sort, rsort.
     * 
     * @param array $arr
     * @param bool $mod
     * @param callable|null $callback
     * 
     * @return array
     */
    public static function order(array $arr, bool $mod = true, callable $callback = null, string $flag = SORT_REGULAR)
    {
        if ($callback) {
            parent::isAssoc($arr)
                ? ($mod ? uasort($arr, $callback) : uksort($arr, $callback))
                : usort($arr, $callback);
        } else {
            parent::isAssoc($arr)
                ? ($mod ? ksort($arr, $flag) : krsort($arr, $flag))
                : ($mod ? sort($arr, $flag) : rsort($arr, $flag));
        }

        return $arr;
    }

    /**
     * Creates an assosiative array out of the keys of the given array
     *  and the plucked values from the same array.
     *
     * @param array $array
     * @param string $keys
     * @return array
     */
    public static function pluckAssoc(array $array, string $keys): array
    {
        return self::combine(array_keys($array), parent::pluck($array, $keys));
    }

    /**
     * It returns an item or an array of items that selected
     * randomly from the array.
     * 
     * @param array $array
     * @param int $length
     * 
     * @return mixed
     */
    public static function rand(array $array, int $length = 1)
    {
        $items = array_slice(parent::shuffle($array), 0, $length);

        return $length == 1 ? self::fetch($items, 0) : $items;
    }

    /**
     * It creates an array of ranged numbers, but max can be anything
     * between min and max.
     * 
     * @param int $max
     * @param int $min
     * 
     * @return array
     */
    public static function range(int $max, int $min = 0): array
    {
        return $min > $max ? range($min, $min) : range($min, rand($min, $max));
    }

    /**
     * It clears falsy values and resets the index.
     * 
     * @param array $array
     * @param callable|null $callback
     * 
     * @return array
     */
    public static function resolve(array $array, callable $callback = null): array
    {
        return array_values(array_filter($array, $callback));
    }

    /**
     * Returns an array of specified keys and their values
     * 
     * @param array $array
     * @param array $keys
     * @param mixed $default
     * @return array
     */
    public static function select(array $array, array $keys, mixed $default = null): array
    {
        return [...self::combine($keys, [], $default), ...parent::only($array, $keys)];
    }

    /**
     * It performs array_splice and returns the array.
     * 
     * @param array $array
     * @param int $offset
     * @param int $length
     * @param mixed $replacement
     * 
     * @return array
     */
    public static function splice(array $array, int $offset, int $length, mixed $replacement = []): array
    {
        array_splice($array, $offset, $length, $replacement);

        return $array;
    }

    /**
     * It moves the given set of items to the first section
     * and other items to the last section of the array.
     * 
     * @param array $array
     * @param array $priorities
     * 
     * @return array
     */
    public static function prioritize(array $array, array $priorities): array
    {
        return array_unique([...array_intersect($priorities, $array), ...$array]);
    }

    /**
     * It returns the unique values of an array after removing
     * falsy values and resetting the index.
     * 
     * @param array $array
     * 
     * @return array
     */
    public static function unique(array $array): array
    {
        return self::resolve(array_unique($array));
    }

    /**
     * It returns the value of the given key after finding the
     * associative array by using another key value.
     * 
     * @param array $array
     * @param int|float|string $search
     * @param string $keys
     * @param string $operator
     * @param string $pluck
     * 
     * @return mixed
     */
    public static function value(
        array $array,
        int|float|string $search,
        string $keys = '',
        string $operator = '=',
        string $pluck = ''
    ) {
        return self::get(self::find($array, $search, $keys, $operator)['value'] ?? [], $pluck);
    }
}
