<?php

namespace Bakgul\LaravelHelpers\Helpers;

class Path
{
    /**
     * Create path from an array and base path.
     * 
     * @param array $parts
     * @param string $glue
     * @return string
     */
    public static function base(array $parts, string $glue = DIRECTORY_SEPARATOR): string
    {
        return self::glue([self::getBase(), ...$parts], $glue);
    }

    /**
     * Remove base path from the given path.
     *
     * @param string $path
     * @param string $base
     * @return string
     */
    public static function baseless(string $path, string $base = ''): string
    {
        $base = $base ?: self::getBase();

        return str_replace($base . DIRECTORY_SEPARATOR, '', $path);
    }

    /**
     * It will return base path even if the helper method base_path() is not ready
     *
     * @return string
     */
    public static function fallbackBase(): string
    {
        return dirname(__DIR__, self::isVendor() ? 5 : 3);
    }

    /**
     * Create a path from an array.
     * 
     * @param array $parts
     * @param string $glue
     * @return string
     */
    public static function glue(array $parts, string $glue = DIRECTORY_SEPARATOR): string
    {
        return implode($glue, $parts);
    }

    /**
     * Set the correct directory separator.
     * 
     * @param string $path
     * @return string
     */
    public static function adapt(string $path): string
    {
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Determine if the path contains the searched item or all items.
     * 
     * @param array|string $path
     * @param array|string $search
     * @return bool
     */
    public static function contains(array|string $path, array|string $search): bool
    {
        return Arr::hasAll(
            is_array($path) ? $path : self::serialize($path, true),
            (array) $search,
            false
        );
    }

    /**
     * Creates missing directories on the path.
     *
     * @param string $path
     * @return array
     */
    public static function complete(string $path): array
    {
        if (file_exists($path)) return [];

        $folders = [];

        $pointer = self::getBase();

        foreach (self::serialize(self::baseless($path, $pointer)) as $folder) {
            $pointer .= DIRECTORY_SEPARATOR . $folder;

            if (file_exists($pointer) || is_file($pointer)) continue;

            mkdir($pointer);

            $folders[] = $pointer;
        }

        return array_reverse($folders);
    }

    /**
     * Determine if the given path or this file's path is a vendor path.
     *
     * @param string $path
     * @return boolean
     */
    public static function isVendor(string $path = ''): bool
    {
        return str_contains($path ?: __DIR__, Str::enclose('vendor', 'DS'));
    }

    /**
     * Convert path to array with or without base path.
     *
     * @param string $path
     * @param boolean $withoutBase
     * @return array
     */
    public static function serialize(string $path, bool $withoutBase = false): array
    {
        return explode(
            DIRECTORY_SEPARATOR,
            $withoutBase ? self::baseless($path) : $path
        );
    }

    /**
     * Convert path tp namespace
     *
     * @param string|array $path
     * @return string
     */
    public static function toNamespace(string|array $path): string
    {
        return implode('\\', array_map(
            fn ($folder) => Convention::namespace($folder, null),
            is_array($path) ? $path : array_filter(Str::serialize($path))
        ));
    }

    private static function getBase(): string
    {
        return function_exists('base_path') ? base_path() : self::fallbackBase();
    }
}
