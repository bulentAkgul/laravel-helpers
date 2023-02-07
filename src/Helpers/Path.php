<?php

namespace Bakgul\LaravelHelpers\Helpers;

class Path
{
    /**
     * Create path from an array and append it to base path.
     * 
     * @param array $parts
     * @param string $glue
     * @return string
     */
    public static function base(array $parts, string $glue = DIRECTORY_SEPARATOR): string
    {
        return base_path(self::glue($parts, $glue));
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

    public static function complete(string $path): void
    {
        if (file_exists($path)) return;

        $pointer = base_path();

        foreach (self::serialize($path, true) as $folder) {

            $pointer = Str::append($pointer, $folder);

            if (file_exists($pointer) || is_file($pointer)) continue;

            mkdir($pointer);
        }
    }

    public static function serialize(string $path, bool $withoutBase = false): array
    {
        return explode(
            DIRECTORY_SEPARATOR,
            $withoutBase ? self::baseless($path) : $path
        );
    }

    public static function baseless(string $path): string
    {
        return str_replace(base_path() . '/', '', $path);
    }
}
