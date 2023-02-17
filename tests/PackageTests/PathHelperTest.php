<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\Path;
use Bakgul\LaravelHelpers\Tests\TestCase;
use Illuminate\Support\Facades\File;

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
            'result' => ''
        ]);

        Path::complete($path);

        $this->assertDirectoryExists($path);

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
