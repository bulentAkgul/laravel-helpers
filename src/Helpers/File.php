<?php

namespace Bakgul\LaravelHelpers\Helpers;

use Illuminate\Support\Facades\File as FileFacade;

class File
{
    /**
     * It calls methods from File facade.
     */
    public static function facade(string $method, ...$args): mixed
    {
        return FileFacade::$method(...$args);
    }

    /**
     * It creates missing folders on the path and create file on the last directory.
     */
    public static function create(string $path, string $file, string $content = ''): string
    {
        Path::complete($path);

        $file = Path::glue([$path, $file]);

        file_put_contents($file, $content);

        return $file;
    }

    /**
     * It gets file content and returns as array or string
     */
    public static function read(string $path, bool $isArray = false): array|string
    {
        return $isArray ? file($path) : file_get_contents($path);
    }

    public static function exists(string $path): bool
    {
        return FileFacade::exists($path);
    }

    public static function missing(string $path): bool
    {
        return FileFacade::missing($path);
    }

    public static function get(string $path, bool $lock = false): string
    {
        return FileFacade::get($path, $lock);
    }

    public static function sharedGet(string $path): string
    {
        return FileFacade::sharedGet($path);
    }

    public static function getRequire(string $path, array $data = []): mixed
    {
        return FileFacade::getRequire($path, $data);
    }

    public static function requireOnce(string $path, array $data = []): mixed
    {
        return FileFacade::requireOnce($path, $data);
    }

    public static function lines(string $path): \Illuminate\Support\LazyCollection
    {
        return FileFacade::lines($path);
    }

    public static function hash(string $path, string $algorithm = 'md5'): string
    {
        return FileFacade::hash($path, $algorithm);
    }

    public static function put(string $path, string $contents, bool $lock = false): int|bool
    {
        return FileFacade::put($path, $contents, $lock);
    }

    public static function replace(string $path, string $content, int|null $mode = null): void
    {
        FileFacade::replace($path, $content, $mode);
    }

    public static function replaceInFile(array|string $search, array|string $replace, string $path): void
    {
        FileFacade::replaceInFile($search, $replace, $path);
    }

    public static function prepend(string $path, string $data): int
    {
        return FileFacade::prepend($path, $data);
    }

    public static function append(string $path, string $data): int
    {
        return FileFacade::append($path, $data);
    }

    public static function chmod(string $path, int|null $mode = null): mixed
    {
        return FileFacade::chmod($path, $mode);
    }

    public static function delete(string|array $paths): bool
    {
        return FileFacade::delete($paths);
    }

    public static function move(string $path, string $target): bool
    {
        return FileFacade::move($path, $target);
    }

    public static function copy(string $path, string $target): bool
    {
        return FileFacade::copy($path, $target);
    }

    public static function link(string $target, string $link): void
    {
        FileFacade::link($target, $link);
    }

    public static function relativeLink(string $target, string $link): void
    {
        FileFacade::relativeLink($target, $link);
    }

    public static function name(string $path): string
    {
        return FileFacade::name($path);
    }

    public static function basename(string $path): string
    {
        return FileFacade::basename($path);
    }

    public static function dirname(string $path): string
    {
        return FileFacade::dirname($path);
    }

    public static function extension(string $path): string
    {
        return FileFacade::extension($path);
    }

    public static function guessExtension(string $path): ?string
    {
        return FileFacade::guessExtension($path);
    }

    public static function type(string $path): string
    {
        return FileFacade::type($path);
    }

    public static function mimeType(string $path): string|false
    {
        return FileFacade::mimeType($path);
    }

    public static function size(string $path): int
    {
        return FileFacade::size($path);
    }

    public static function lastModified(string $path): int
    {
        return FileFacade::lastModified($path);
    }

    public static function isDirectory(string $directory): bool
    {
        return FileFacade::isDirectory($directory);
    }

    public static function isEmptyDirectory(string $directory, bool $ignoreDotFiles = false): bool
    {
        return FileFacade::isEmptyDirectory($directory, $ignoreDotFiles);
    }

    public static function isReadable(string $path): bool
    {
        return FileFacade::isReadable($path);
    }

    public static function isWritable(string $path): bool
    {
        return FileFacade::isWritable($path);
    }

    public static function hasSameHash(string $firstFile, string $secondFile): bool
    {
        return FileFacade::hasSameHash($firstFile, $secondFile);
    }

    public static function isFile(string $file): bool
    {
        return FileFacade::isFile($file);
    }

    public static function glob(string $pattern, int $flags = 0): array
    {
        return FileFacade::glob($pattern, $flags);
    }

    public static function files(string $directory, bool $hidden = false)
    {
        return FileFacade::files($directory, $hidden);
    }

    public static function allFiles(string $directory, bool $hidden = false): array
    {
        return FileFacade::allFiles($directory, $hidden);
    }

    public static function directories(string $directory): array
    {
        return FileFacade::directories($directory);
    }

    public static function ensureDirectoryExists(string $path, int $mode = 0755, bool $recursive = true): void
    {
        FileFacade::ensureDirectoryExists($path, $mode, $recursive);
    }

    public static function makeDirectory(string $path, int $mode = 0755, bool $recursive = false, bool $force = false): bool
    {
        return FileFacade::makeDirectory($path, $mode, $recursive, $force);
    }

    public static function moveDirectory(string $from, string $to, bool $overwrite = false): bool
    {
        return FileFacade::moveDirectory($from, $to, $overwrite);
    }

    public static function copyDirectory(string $directory, string $destination, int|null $options = null): bool
    {
        return FileFacade::copyDirectory($directory, $destination, $options);
    }

    public static function deleteDirectory(string $directory, bool $preserve = false): bool
    {
        return FileFacade::deleteDirectory($directory, $preserve);
    }

    public static function deleteDirectories(string $directory): bool
    {
        return FileFacade::deleteDirectories($directory);
    }

    public static function cleanDirectory(string $directory): bool
    {
        return FileFacade::cleanDirectory($directory);
    }

    public static function when(mixed $value = null, callable|null $callback = null, callable|null $default = null): mixed
    {
        return FileFacade::when($value, $callback, $default);
    }

    public static function unless(mixed $value = null, callable|null $callback = null, callable|null $default = null): mixed
    {
        return FileFacade::unless($value, $callback, $default);
    }
    public static function macro(string $name, object|callable $macro): void
    {
        FileFacade::macro($name, $macro);
    }

    public static function mixin(object $mixin, bool $replace = true): void
    {
        FileFacade::mixin($mixin, $replace);
    }

    public static function hasMacro(string $name): bool
    {
        return FileFacade::hasMacro($name);
    }

    public static function flushMacros(): void
    {
        FileFacade::flushMacros();
    }
}
