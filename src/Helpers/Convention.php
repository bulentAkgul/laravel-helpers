<?php

namespace Bakgul\LaravelHelpers\Helpers;

/**
 * When $isSingular is null, the given string won't be converted to its singular or plural form.
 */

class Convention
{
    /**
     * It formats the string to create a class name based on Laravel's naming convention.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */
    public static function class(string $value, ?bool $isSingular = true)
    {
        return $value ? self::pascal($value, $isSingular) : '';
    }

    /**
     * It formats the string to create a part of a namespace PSR convention.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */
    public static function namespace($value, ?bool $isSingular = false)
    {
        return $value ? self::pascal($value, $isSingular) : '';
    }

    /**
     * It formats the string to create a method name based on PSR convention.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */
    public static function method($value, ?bool $isSingular = null)
    {
        return $value ? self::camel($value, $isSingular) : '';
    }

    /**
     * It formats the string to camel case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */

    public static function var($value, ?bool $isSingular = true)
    {
        return $value ? self::camel($value, $isSingular) : '';
    }

    /**
     * It formats the string to snake case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */

    public static function table($value, ?bool $isSingular = false)
    {
        return $value ? self::snake($value, $isSingular) : '';
    }

    /**
     * It formats the string to pascal case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */
    public static function affix(string $value, ?bool $isSingular = true)
    {
        return $value ? self::pascal($value, $isSingular) : '';
    }

    /**
     * It formats the string to plural kebab case.
     *
     * @param string $value
     * @param boolean|null $isSingular
     * @return string
     */
    public static function route(string $value, ?bool $isSingular = false): string
    {
        return $value ? self::kebab($value, $isSingular) : '';
    }

    /**
     * It formats the string to specified case, which is pascal by default.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * 
     * @return array|string
     */
    public static function folder(string $value, string $case = "pascal", bool $isSingular = null): string
    {
        return $value ? self::convert($value, $case, $isSingular) : '';
    }

    /**
     * It formats the string to the specified case.
     * 
     * @param string $value
     * @param string|null $case
     * @param bool|null $isSingular
     * 
     * @return array|string
     */
    public static function convert(string $value, string $case = null, bool|string $isSingular = null): string
    {
        if (!$value) return $value;

        $isSingular = is_string($isSingular) ? Pluralizer::set($isSingular) : $isSingular;

        $case = $case ?? self::case($value);

        return self::$case(Str::kebab($value), $isSingular, false);
    }

    /**
     * It formats the string to kebab case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * @param bool $returnArray
     * 
     * @return array|string
     */
    public static function kebab(string $value, bool $isSingular = null, bool $returnArray = false): array|string
    {
        return self::output(Str::toLower(self::prepare($value, $isSingular)), 'kebab', $returnArray);
    }

    /**
     * It formats the string to snake case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * @param bool $returnArray
     * 
     * @return array|string
     */
    public static function snake(string $value, bool $isSingular = null, bool $returnArray = false): array|string
    {
        return self::output(Str::toLower(self::prepare($value, $isSingular)), 'snake', $returnArray);
    }

    /**
     * It formats the string to pascal case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * @param bool $returnArray
     * 
     * @return array|string
     */
    public static function pascal(string $value, bool $isSingular = null, bool $returnArray = false): array|string
    {
        return self::output(Str::capitalize(self::prepare($value, $isSingular)), 'pascal', $returnArray);
    }

    /**
     * It formats the string to camek case.
     * 
     * @param string $value
     * @param bool|null $isSingular
     * @param bool $returnArray
     * 
     * @return array|string
     */
    public static function camel(string $value, bool $isSingular = null, bool $returnArray = false): array|string
    {
        $name = Str::capitalize(self::prepare($value, $isSingular));

        $name[0] = strtolower($name[0]);

        return self::output($name, 'camel', $returnArray);
    }

    protected static function prepare(array|string $value, ?bool $isSingular)
    {
        return Pluralizer::run(self::separate(self::replaceByGlue($value)), $isSingular);
    }

    protected static function output(array $name, string $case, bool $returnArray)
    {
        return $returnArray ? $name : implode(self::glue($case), $name);
    }

    protected static function glue(string $case): string
    {
        return ['kebab' => '-', 'snake' => '_'][$case] ?? '';
    }

    protected static function case(string $value)
    {
        return match (true) {
            str_contains($value, '-') => 'kebab',
            str_contains($value, '_') => 'snake',
            ctype_upper($value[0]) => 'pascal',
            default => 'camel'
        };
    }

    protected static function separate(array|string $value): array
    {
        if (is_array($value)) return $value;

        $words = explode('-', $value);

        if (count($words) > 1) return Arr::resolve($words);

        $words = explode('_', $value);

        if (count($words) > 1) return Arr::resolve($words);

        return ctype_upper($value) ? [strtolower($value)] : Arr::resolve(Str::split($value, '/(?=[A-Z])/'));
    }

    protected static function replaceByGlue(array|string $value, string $glue = '-'): array|string
    {
        return is_array($value) ? $value : preg_replace('/[^A-Za-z0-9\-]/', $glue, $value);
    }
}
