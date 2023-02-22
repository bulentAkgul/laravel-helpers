<?php

namespace Bakgul\LaravelHelpers\Helpers;

use Illuminate\Support\Str as BaseStr;

class Str extends BaseStr
{
    /**
     * Append the string to the base by using glue if string exists.
     * 
     * @param string $base
     * @param string $str
     * @param string $glue
     * @return string
     */
    public static function append(string $base, string $str = '', string $glue = DIRECTORY_SEPARATOR): string
    {
        return $base . ($str ? "{$glue}{$str}" : $str);
    }

    /**
     * Prepend the string to the base by using glue if string exists.
     * 
     * @param string $base
     * @param string $str
     * @param string $glue
     * @return string
     */
    public static function prepend(string $base, string $str = '', string $glue = DIRECTORY_SEPARATOR): string
    {
        return ($str ? "{$str}{$glue}" : $str) . $base;
    }

    /**
     * Inject the string between strings in a squence by using enclose method.
     * 
     * @param string $str
     * @param array|string $glue
     * @return string
     */
    public static function inject(string $str = '', array|string $glue = DIRECTORY_SEPARATOR): string
    {
        if (!$str || !$glue) return $str;

        foreach (is_array($glue) ? array_reverse($glue) : [$glue] as $wrap) {
            $str = self::enclose($str, $wrap);
        }

        return $str;
    }

    /**
     * Wrap the given string with the given character.
     * 
     * @param string $str
     * @param string $glue
     * @return string
     */
    public static function enclose(string $str, string $glue = DIRECTORY_SEPARATOR): string
    {
        if (!$str || !$glue) return $str;

        $glue = [
            'bt' => ['`', '`'],
            'sq' => ["'", "'"],
            'dq' => ['"', '"'],
            '{' => ['{', '}'],
            '(' => ['(', ')'],
            '[' => ['[', ']'],
            '<' => ['<', '>']
        ][$glue] ?? [$glue, $glue];

        return "{$glue[0]}{$str}{$glue[1]}";
    }

    /**
     * Compare two strings to check if they are the same or the first contains the second.
     * 
     * @param string $str1
     * @param string $str2
     * @param string $operator
     * @return bool
     */
    public static function compare(string $str1, string $str2, string $operator = '='): bool
    {
        return ($operator == '==' && $str1 == $str2)
            || ($operator == '=' && $str2 && str_contains($str1, $str2));
    }

    /**
     * Determine if string contains the given value.
     * 
     * @param string $str
     * @param string $search
     * @return bool
     */
    public static function has(string $str, string $search, bool $isWordByWord = false): bool
    {
        return $isWordByWord
            ? preg_match('/\b(' . $search . ')\b/', $str)
            : str_contains($str, $search);
    }

    /**
     * Determine if string contains the given value.
     * 
     * @param string $str
     * @param string $search
     * @return bool
     */
    public static function hasNot(string $str, string $search): bool
    {
        return !self::has($str, $search);
    }

    /**
     * Determine if the string contains some of the given values.
     * 
     * @param string $str
     * @param string|array $search
     * @return bool
     */
    public static function hasSome(string $str, string|array $search, bool $isWordByWord = false): bool
    {
        return array_reduce(
            (array) $search,
            fn ($p, $c) => $p || self::has($str, $c, $isWordByWord),
            false
        );
    }

    /**
     * Determine if the string doesn't contain none of the given values.
     * 
     * @param string $str
     * @param string|array $search
     * @return bool
     */
    public static function hasNone(string $str, string|array $search): bool
    {
        return !self::hasSome($str, $search);
    }

    /**
     * Determine if the string contains some of the given values.
     * 
     * @param string $str
     * @param array $search
     * @return bool
     */
    public static function hasAll(string $str, array $search, bool $isWordByWord = false): bool
    {
        return array_reduce(
            (array) $search,
            fn ($p, $c) => $p && self::has($str, $c, $isWordByWord),
            true
        );
    }

    /**
     * Get the portion of a string after the separator in the specified length as a string or array.
     * 
     * @param string $str
     * @param string $seperator
     * @param int $length
     * @param bool $isStr
     * @return array<string>|bool|string
     */
    public static function getTail(string $str, string $seperator = DIRECTORY_SEPARATOR, int $length = 1, bool $isStr = true)
    {
        $parts = array_reverse(array_slice(array_reverse(explode($seperator, $str)), 0, $length));

        return $isStr ? implode($seperator, $parts) : $parts;
    }

    /**
     * Replace the tail of the string with the given one.
     * 
     * @param string $str
     * @param string $add
     * @param string $glue
     * @param int $length
     * @return string
     */
    public static function changeTail(string $str, array|string $add, string $glue = DIRECTORY_SEPARATOR, int $length = 1): string
    {
        return self::prepend(implode($glue, (array) $add), self::dropTail($str, $glue, $length), $glue);
    }

    /**
     * Remove the tail from the string.
     * 
     * @param string $value
     * @param string $seperator
     * @param int $length
     * @return string
     */
    public static function dropTail(string $value = '', string $seperator = DIRECTORY_SEPARATOR, int $length = 1)
    {
        return implode($seperator, array_slice(explode($seperator, $value), 0, -1 * $length));
    }

    /**
     * Create an array of head and tail out of path based on the separator and length.
     *
     * @param string $value
     * @param [type] $seperator
     * @param integer $length
     * @return array
     */
    public static function separateTail(string $value = '', string $seperator = DIRECTORY_SEPARATOR, int $length = 1): array
    {
        return [self::dropTail($value, $seperator, $length), self::getTail($value, $seperator, $length)];
    }

    public static function split(string $text, string $pattern = '/\R/'): array
    {
        return preg_split($pattern, $text);
    }

    public static function capitalize(array|string $words, string $glue = '-')
    {
        return self::format('ucfirst', $words, $glue);
    }

    public static function toLower(array|string $words, string $glue = '-')
    {
        return self::format('strtolower', $words, $glue);
    }

    public static function toUpper(array|string $words, string $glue = '-')
    {
        return self::format('strtoupper', $words, $glue);
    }

    public static function format(string $method, array|string $words, string $glue = '-'): array
    {
        return array_map(fn ($x) => $method($x), is_string($words) ? explode($glue, $words) : $words);
    }

    /**
     * Trim the string with given and default characters 
     *
     * @param string $str
     * @param string $characters
     * @param boolean $append
     * @return string
     */
    public static function trim(string $str, string $characters = '', bool $append = true): string
    {
        return trim($str, $characters . ($append ? " ,;\t\n\r" : ""));
    }

    /**
     * Create array out of string.
     *
     * @param string $value
     * @param string $glue
     * @return array
     */
    public static function serialize(string $str, string $glue = DIRECTORY_SEPARATOR): array
    {
        return explode($glue, $str);
    }

    /**
     * It uses placeholder as keys to replace them with their associated values in array.
     *
     * @param array $map
     * @param string $string
     * @param boolean $append
     * @param [type] $glue
     * @return string
     */
    public static function replaceByMap(array $map, string $string, bool $append = false, string $glue = DIRECTORY_SEPARATOR): string
    {
        return str_replace(
            array_map(fn ($x) => "{{ {$x} }}", array_keys($map)),
            array_map(fn ($x) => $append ? self::append('', $x, $glue) : $x, array_values($map)),
            $string
        );
    }
}
