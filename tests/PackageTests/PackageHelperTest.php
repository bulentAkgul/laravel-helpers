<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\Arr;
use Bakgul\LaravelHelpers\Helpers\Package;
use Bakgul\LaravelHelpers\Helpers\Path;
use Bakgul\LaravelHelpers\Helpers\Str;
use Bakgul\LaravelHelpers\Tests\TestCase;
use Illuminate\Support\Facades\File;

class PackageHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Package::class,
            'test' => debug_backtrace()[1]['function'],
            'args' => [],
            ...$props
        ]);
    }
    /** @test */
    public function container_will_return_package_container_path(): void
    {
        config()->set('packages.container', 'packs');

        $this->toReadme([
            'method' => 'container',
            'message' => "Before calling this method, we set the folder name to config('packages.container'). It will return 'packages' if you don't set anything.",
        ]);

        $this->assertEquals(base_path('packs'), Package::container());
    }

    /** @test */
    public function path_will_return_the_package_path_if_it_exists(): void
    {
        $container = $this->container();
        $package = Str::getTail($this->packages[1]);

        $this->makePackages($container);

        $this->toReadme([
            'method' => 'path',
            'args' => [$package]
        ]);

        $this->assertEquals(
            "{$container}/{$this->packages[1]}",
            Package::path($package)
        );

        $this->deletePackages($container);
    }

    /** @test */
    public function list_will_return_a_list_of_package_paths_in_specified_root_or_all_roots(): void
    {
        $container = $this->container();

        $this->makePackages($container);

        $this->toReadme([
            'method' => 'list',
            'args' => []
        ]);

        $this->assertEquals(
            Arr::order(array_map(fn ($x) =>  "{$container}/{$x}", $this->packages)),
            Arr::order(Package::list())
        );

        $this->deletePackages($container);
    }

    private function container(string $name = 'packages'): string
    {
        $container = $this->testBase($name);

        config()->set(
            'packages.container',
            str_replace(base_path() . '/', '', $container)
        );

        return $container;
    }

    private function makePackages(string $container): void
    {
        foreach ($this->packages as $package) {
            Path::complete("{$container}/$package");
        }
    }

    private function deletePackages(string $container): void
    {
        File::deleteDirectory($container);
    }

    private array $packages = [
        'core/users',
        'core/roles',
        'features/books',
        'features/posts',
    ];
}
