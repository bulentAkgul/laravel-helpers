<?php

namespace Bakgul\LaravelHelpers\Helpers;

class Package
{
    public static function container(): string
    {
        return base_path(config('packages.container', 'packages'));
    }

    public static function path(string $name, string $tail = ''): ?string
    {
        if (!$name) return null;

        $container = self::container();

        foreach (Folder::content($container) as $folder) {
            $package = Path::glue([$container, $folder, $name]);

            if (file_exists($package)) return Str::append($package, $tail);
        }

        return null;
    }

    public static function list(string $root = '', bool $isPath = true): array
    {
        $packages = [];

        $path = Str::append(self::container(), $root);

        foreach (Folder::content($path) as $folder) {
            $package = $root ? $folder : '';

            if ($package) {
                $packages[] = Str::append($path, $package);

                continue;
            }

            $rootPath = Str::append($path, $folder);

            foreach (Folder::content($rootPath) as $package) {
                $packages[] = Path::glue([$rootPath, $package]);
            }
        }

        return $isPath ? $packages : self::names($packages);
    }

    public static function names(array $packages): array
    {
        return array_map(fn ($x) => Str::getTail($x), $packages);
    }

    public static function root(?string $name): string
    {
        foreach (Arr::pluck(config('packagify.roots'), 'folder') as $folder) {
            if (in_array($name, Folder::content(
                base_path(Str::prepend(self::container()) . $folder)
            ))) return $folder;
        }

        return '';
    }
}
