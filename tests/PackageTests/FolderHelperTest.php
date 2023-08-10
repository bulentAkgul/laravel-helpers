<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\File;
use Bakgul\LaravelHelpers\Helpers\Folder;
use Bakgul\LaravelHelpers\Tests\TestCase;

class FolderHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Folder::class,
            'test' => debug_backtrace()[1]['function'],
            ...$props
        ]);
    }

    /** @test */
    public function make_will_make_a_directory_for_the_given_path(): void
    {
        $path = $this->testBase('new_dir');

        $this->toReadme([
            'method' => 'make',
            'args' => [$path],
            'result' => 'new_dir has been created under TestBase.' . "\n// To create multiple directories use Path::complete()"
        ]);

        Folder::make($path);

        $this->assertDirectoryExists($path);

        File::deleteDirectory($path);
    }

    /** @test */
    public function get_will_return_the_folder_name_from_config(): void
    {
        $key = 'dummy';
        $folder = 'DummyFolder';

        config()->set("packagify.folders.{$key}", $folder);

        $this->toReadme([
            'message' => "config('packagify.folders.dummy') == DummyFolder",
            'method' => 'get',
            'args' => [$key]
        ]);

        $this->assertEquals($folder, Folder::get($key));
    }

    /** @test */
    public function content_will_return_a_list_of_files_and_directories_on_a_folder(): void
    {
        $args = [$this->testBase(), ['y.php']];

        $this->toReadme([
            'method' => 'content',
            'args' => $args
        ]);

        $this->assertEquals(
            ['a', 'b', 'x.php', 'z.php'],
            array_values(Folder::content(...$args))
        );
    }

    /** @test */
    public function contains_will_determine_if_the_searched_item_is_on_the_folder(): void
    {
        $args = [$this->testBase(), ['a', 'y.php']];

        $this->toReadme([
            'method' => 'contains',
            'args' => $args
        ]);

        $this->assertTrue(Folder::contains(...$args));
    }

    /** @test */
    public function files_will_return_a_path_list_of_files_on_a_folder_and_its_subfolders(): void
    {
        $args = [$this->testBase()];

        $this->toReadme([
            'method' => 'files',
            'args' => $args
        ]);

        $this->assertEquals(
            [
                '/var/www/html/package/tests/TestBase/a/a.php',
                '/var/www/html/package/tests/TestBase/a/c/c.php',
                '/var/www/html/package/tests/TestBase/b/b.php',
                '/var/www/html/package/tests/TestBase/x.php',
                '/var/www/html/package/tests/TestBase/y.php',
                '/var/www/html/package/tests/TestBase/z.php',
            ],
            Folder::files(...$args)
        );
    }

    /** @test */
    public function is_empty_will_check_if_the_folder_is_empty(): void
    {
        $dir = $this->testBase('empty-dir');
        $args = [$dir];

        mkdir($dir);

        $this->toReadme([
            'method' => 'isEmpty',
            'args' => $args,
        ]);

        $this->assertTrue(Folder::isEmpty($dir));

        rmdir($dir);

        $dir = $this->testBase('not-empty-dir');
        $file = $dir . DIRECTORY_SEPARATOR . 'file.txt';

        $args = [$dir, ['file.txt']];

        mkdir($dir);
        file_put_contents($file, '');

        $this->toReadme([
            'message' => 'not-empty-dir contains only file.txt and therefore, it is empty except file.txt.',
            'method' => 'isEmpty',
            'args' => $args,
        ]);

        $this->assertFalse(Folder::isEmpty($dir));
        $this->assertTrue(Folder::isEmpty(...$args));

        unlink($file);
        rmdir($dir);
    }

    /** @test */
    public function name_will_create_a_folder_name_with_given_parts_by_converting_them(): void
    {
        $args = ['user', 'service', 'authenticated', false];

        $this->toReadme([
            'method' => 'name',
            'args' => $args
        ]);

        $this->assertEquals(
            'AuthenticatedUserServices',
            Folder::name(...$args)
        );
    }

    /** @test */
    public function tree_will_generate_a_path_list_of_files_in_a_multidimentional_array(): void
    {
        $args = [$this->testBase()];

        $this->toReadme([
            'method' => 'tree',
            'args' => $args
        ]);

        $this->assertEquals(
            [
                'a' => [
                    'a.php' => '/var/www/html/package/tests/TestBase/a/a.php',
                    'c' => [
                        'c.php' => '/var/www/html/package/tests/TestBase/a/c/c.php'
                    ]
                ],
                'b' => [
                    'b.php' => '/var/www/html/package/tests/TestBase/b/b.php'
                ],
                'x.php' => '/var/www/html/package/tests/TestBase/x.php',
                'y.php' => '/var/www/html/package/tests/TestBase/y.php',
                'z.php' => '/var/www/html/package/tests/TestBase/z.php',
            ],
            Folder::tree(...$args)
        );
    }

    /** @test */
    public function refresh_will_delete_all_items_in_a_folder_or_create_one_unless_it_exists(): void
    {
        $path = $this->testBase('b');

        $before = Folder::content($path);

        $this->toReadme([
            'method' => 'refresh',
            'args' => [$path]
        ]);

        Folder::refresh($path);

        $after = Folder::content($path);

        $this->assertNotEmpty($before);

        $this->assertEmpty($after);

        file_put_contents("{$path}/b.php", '');
    }
}
