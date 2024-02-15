<?php

namespace Bakgul\LaravelHelpers\Helpers;

use Bakgul\LaravelHelpers\Helpers\File;

class Folder
{
    /**
     * It will empty the specified directory of all files and folders.
     *
     * @param string $path
     * @return string
     */
    public static function clean(string $path): string
    {
        $result = File::cleanDirectory($path);

        return $result ? $path : '';
    }

    /**
     * It will create directories when they are missing.
     *
     * @param string $path
     * @param integer $mode
     * @param boolean $recursive
     * @return string
     */
    public static function complete(string $path, int $mode = 0755, bool $recursive = true): string
    {
        File::ensureDirectoryExists($path, $mode, $recursive);

        return $path;
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
     * It returns the list of names of the folders and files on the given path
     * after excluding the items that passed in argument.
     * 
     * @param string $path
     * @param array|callable $except
     * 
     * @return array
     */
    public static function content(string $path, array|callable $except = []): array
    {
        $content = file_exists($path) ? array_diff(scandir($path), ['.', '..']) : [];

        if (!$content) return $content;

        return is_callable($except) ? Arr::where($content, $except) : array_diff($content, $except);
    }

    /**
     * It will copy the directory to the new destination and return
     * the target path if everything works.
     *
     * @param string $from
     * @param string $to
     * @param int|null $options
     * @return string
     */
    public static function copy(string $from, string $to, int|null $options = null): string
    {
        $result = File::copyDirectory($from, $to, $options);

        return $result ? $to : '';
    }

    /**
     * It deletes a directory recursively.
     *
     * @param string $path
     * @return bool
     */
    public static function delete(string $path, bool $preserve = false): bool
    {
        return File::deleteDirectory($path, $preserve);
    }

    /**
     * It will remove all of the directories within a given directory.
     *
     * @param string $directory
     * @return boolean
     */
    public static function deleteChildDirs(string $path): bool
    {
        return File::deleteDirectories($path);
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
            default => array_filter($paths, fn ($x) => Path::contains($x, $callback))
        };
    }

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
     * It will check if the given ğath is a directory
     *
     * @param string $path
     * @return string
     */
    public static function is(string $path): bool
    {
        return File::isDirectory($path);
    }

    /**
     * It will check if the given ğath is a directory
     *
     * @param string $path
     * @return string
     */
    public static function isNot(string $path): bool
    {
        return !self::is($path);
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
     * It will create a directory on the given path.
     *
     * @param string $path
     * @return string
     */
    public static function make(string $path, int $mode = 0755, bool $recursive = false, bool $force = false): string
    {
        if (file_exists($path) || is_file($path)) return '';

        $result = File::makeDirectory($path, $mode, $recursive, $force);

        return $result ? $path : '';
    }

    /**
     * It will move the directory to the given path.
     *
     * @param string $from
     * @param string $to
     * @param bool $overwrite
     * @return string
     */
    public static function move(string $from, string $to, bool $overwrite = false): string
    {
        $result = File::moveDirectory($from, $to, $overwrite);

        return $result ? $to : '';
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
     * It will return all paths on a directory including files and empty folders.
     *
     * @param string $path
     * @param array|callable|string|null $callback
     * @return array
     */
    public static function paths(string $path, array|callable|string $callback = null): array
    {
        $paths = [];

        foreach (self::content($path) as $item) {
            $itemPath = Path::glue([$path, $item]);

            $paths[] = $itemPath;

            if (is_dir($itemPath)) {
                $paths = array_merge($paths, self::paths($itemPath));
            }
        }

        return match (true) {
            is_null($callback) => $paths,
            is_callable($callback) => array_filter($paths, $callback),
            default => array_filter($paths, fn ($x) => Path::contains($x, $callback))
        };
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
        return file_exists($path) ? File::cleanDirectory($path) : Path::complete($path);
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

    private static function removeExtraSeperator(string $path): string
    {
        return str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path);
    }
}
