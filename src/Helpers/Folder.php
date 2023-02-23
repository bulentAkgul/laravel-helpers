<?php

namespace Bakgul\LaravelHelpers\Helpers;

use Bakgul\LaravelHelpers\Helpers\File;

class Folder
{
    /**
     * It returns the folder name from config
     * 
     * @param string $folder
     * @return string
     */
    public static function get(string $folder): string
    {
        return config("packagify.folders.{$folder}", $folder);
    }

    /**
     * It returns the list of names of the folders and files on the given path
     * after excluding the items that passed in argument.
     * 
     * @param string $path
     * @param array $except
     * 
     * @return array
     */
    public static function content(string $path, array $except = []): array
    {
        return file_exists($path) ? array_diff(scandir($path), array_merge(['.', '..'], $except)) : [];
    }

    /**
     * It determines if the folder is empty.
     *
     * @param string $path
     * @param array $except
     * @return boolean
     */
    public static function isEmpty(string $path, array $except = []): bool
    {
        return empty(array_diff(self::content($path), $except));
    }

    /**
     * It determines if the item in folder.
     * 
     * @param string $path
     * @param array|string $name
     * 
     * @return bool
     */
    public static function contains(string $path, array|string $name): bool
    {
        return Arr::hasAll(self::content($path), (array) $name);
    }

    /**
     * It returns the list of paths of files under the specified folder including its subfolders.
     * 
     * @param string $path
     * @param array|callable|string $callback
     * 
     * @return array
     */
    public static function files(string $path, array|callable|string $callback = null): array
    {
        $paths = [];

        foreach (self::content($path) as $item) {
            $itemPath = self::removeExtraSeperator(Path::glue([$path, $item]));

            if (is_dir($itemPath)) {
                $paths = array_merge($paths, self::files($itemPath));
            } else {
                $paths[] = $itemPath;
            }
        }

        return match (true) {
            is_null($callback) => $paths,
            is_callable($callback) => array_filter($paths, $callback),
            default => array_filter(array_map(fn ($x) => Path::contains($x, $callback), $paths))
        };
    }

    /**
     * It creates a folder name based on PSR convintion.
     * 
     * @param string $value
     * @param string $suffix
     * @param string $prefix
     * @param bool $isSingular
     * 
     * @return string
     */
    public static function name(string $value, string $suffix = '', string $prefix = '', bool $isSingular = false)
    {
        return Convention::affix($prefix) . Convention::class($value) . Convention::affix($suffix, $isSingular);
    }

    /**
     * It creates a file/folder structure of the specified folder
     * and its subfolders in a nested associative array.
     * 
     * @param string $path
     * @return array
     */
    public static function tree(string $path): array
    {
        $tree = [];

        foreach (self::content($path) as $item) {
            $itemPath = self::removeExtraSeperator(Path::glue([$path, $item]));
            $tree[$item] = is_dir($itemPath) ? self::tree($itemPath) : $itemPath;
        }

        return $tree;
    }

    /**
     * It deletes the items in a folder or create the folder unless it exists.
     * 
     * @param mixed $path
     * 
     * @return bool
     */
    public static function refresh($path)
    {
        return file_exists($path) ? File::cleanDirectory($path) : mkdir($path);
    }

    private static function removeExtraSeperator(string $path): string
    {
        return str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path);
    }
}
