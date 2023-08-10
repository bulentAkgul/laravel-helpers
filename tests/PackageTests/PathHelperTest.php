<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\File;
use Bakgul\LaravelHelpers\Helpers\Path;
use Bakgul\LaravelHelpers\Tests\TestCase;

class PathHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Path::class,
            'test' => debug_backtrace()[1]['function'],
            ...$props
        ]);
    }

    /** @test */
    public function base_will_implode_array_as_path_and_append_to_base_path(): void
    {
        $folders = ['services', 'user-services'];

        $this->toReadme([
            'method' => 'base',
            'args' => [$folders]
        ]);

        $this->assertEquals(
            base_path('services/user-services'),
            Path::base($folders)
        );
    }

    /** @test */
    public function glue_will_convert_array_to_path(): void
    {
        $folders = ['services', 'user-services'];

        $this->toReadme([
            'method' => 'glue',
            'args' => [$folders]
        ]);

        $this->assertEquals(
            'services/user-services',
            Path::glue($folders)
        );
    }

    /** @test */
    public function adapt_will_replace_slashes_to_directory_seperator(): void
    {
        $path = 'services\user-services\subfolder';

        $this->toReadme([
            'method' => 'adapt',
            'args' => [$path]
        ]);

        $this->assertEquals(
            'services/user-services/subfolder',
            Path::adapt($path)
        );
    }

    /** @test */
    public function contains_will_determine_if_the_given_terms_are_in_the_path(): void
    {
        $args = [
            'sub1/sub2/sub3/sub4',
            ['sub1', 'sub3']
        ];

        $this->toReadme([
            'method' => 'contains',
            'args' => $args
        ]);

        $this->assertTrue(Path::contains(...$args));
    }

    /** @test */
    public function complete_will_create_missing_folders_in_the_given_path(): void
    {
        $path = $this->testBase('sub1/sub2/sub3');

        $this->toReadme([
            'method' => 'complete',
            'args' => [$path],
            'result' => 'sub1, sub2, and sub3 have been created.'
        ]);

        Path::complete($path);

        $this->assertDirectoryExists($path);

        File::deleteDirectory($this->testBase('sub1'));
    }

    /** @test */
    public function complete_will_create_missing_folders_in_the_given_path_and_its_children(): void
    {
        $path = $this->testBase('sub1/sub2/sub3');
        $children = ['sub4', 'sub5/sub6'];

        $this->toReadme([
            'method' => 'complete',
            'args' => [$path, $children],
            'result' => implode("\n", [
                'The missing folders on the following paths have been created:',
                "//     {$path}/{$children[0]}",
                "//     {$path}/{$children[1]}",
            ])
        ]);

        Path::complete($path, $children);

        $this->assertDirectoryExists("{$path}/{$children[0]}");
        $this->assertDirectoryExists("{$path}/{$children[1]}");

        File::deleteDirectory($this->testBase('sub1'));
    }

    /** @test */
    public function serialize_will_explode_path_with_directory_seperator(): void
    {
        $path = base_path('services/user-services/authenticated-user-services');

        $this->toReadme([
            'method' => 'serialize',
            'args' => [$path]
        ]);

        $this->assertEquals(
            ['services', 'user-services', 'authenticated-user-services'],
            Path::serialize($path, true)
        );
    }

    /** @test */
    public function baseless_will_remove_base_path_from_path(): void
    {
        $path = base_path('services/user-services');

        $this->toReadme([
            'method' => 'baseless',
            'args' => [$path]
        ]);

        $this->assertEquals(
            'services/user-services',
            Path::baseless($path)
        );
    }

    /** @test */
    public function fallback_base_will_return_the_base_path_without_using_base_path_helper(): void
    {
        $this->toReadme([
            'method' => 'fallbackBase',
            'args' => []
        ]);

        $this->assertEquals(
            base_path(),
            Path::fallbackBase()
        );
    }

    /** @test */
    public function is_vendor_will_determine_if_the_path_is_vendor_path(): void
    {
        $path = 'something/that/has/vendor/wrapped/with/directory/separators';

        $this->toReadme([
            'test' => 'is_vendor_will_check_if_the_given_path_is_a_vendor_path',
            'method' => 'isVendor',
            'args' => [$path]
        ]);

        $this->assertTrue(Path::isVendor($path));

        $this->toReadme([
            'test' => 'is_vendor_will_check_if_its_class_in_vendor_path_when_no_path_is_provided',
            'method' => 'isVendor',
            'args' => []
        ]);

        $this->assertFalse(Path::isVendor());
    }

    /** @test */
    public function to_namespace_will_create_a_namespace_out_of_path(): void
    {
        $args = ['users/user-services/index-user-services'];

        $this->toReadme([
            'method' => 'toNamespace',
            'args' => $args
        ]);

        $this->assertEquals(
            'Users\UserServices\IndexUserServices',
            Path::toNamespace(...$args)
        );
    }
}
