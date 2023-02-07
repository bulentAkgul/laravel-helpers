<?php

namespace Bakgul\LaravelHelpers\Helpers;

class Pluralizer
{
    public static function make(array|string $value, array|string $data = '', ?bool $isSingular = null)
    {
        return self::run($value, $isSingular ?? self::set($data));
    }

    public static function run(array|string $value, ?bool $isSingular = null): array|string
    {
        $last = is_array($value) ? array_pop($value) : $value;

        $last = $isSingular === null ? $last : ($isSingular ? Str::singular($last) : Str::plural($last));

        return is_array($value) ? [...$value, $last] : $last;
    }

    public static function set(array|string $data, string $key = 'name_count'): ?bool
    {
        $singular = ['S' => true, 'P' => false, 'X' => null];

        if (is_string($data)) return Arr::get($singular, $data);

        $value = Arr::get($data, $key);

        return $value == null ? $value : Arr::get($singular, $value);
    }
}
