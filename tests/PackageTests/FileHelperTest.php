<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\File;
use Bakgul\LaravelHelpers\Tests\TestCase;

class FileHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => File::class,
            'test' => debug_backtrace()[1]['function'],
            ...$props
        ]);
    }

    /** @test */
    public function create_will_create_a_file_with_the_given_content_after_creating_missing_folders_on_the_path(): void
    {
        $args = [
            $this->testBase('new/newer/newest'),
            'x.php',
            'new x'
        ];

        $this->assertDirectoryDoesNotExist($this->testBase('new'));

        $this->toReadme([
            'method' => 'create',
            'args' => $args,
            'result' => 'a new file created.'
        ]);

        File::create(...$args);

        $file = "{$args[0]}/{$args[1]}";

        $this->assertFileExists($file);

        $this->assertEquals($args[2], file_get_contents($file));

        File::deleteDirectory($this->testBase('new'));
    }

    /** @test */
    public function read_returns_the_content_of_file_as_string_or_array(): void
    {
        $args = [
            $this->testBase('new'),
            'x.txt',
        ];

        File::create($args[0], $args[1], "new x\nnew y");

        $this->toReadme([
            'method' => 'read',
            'args' => $a = ["{$args[0]}/{$args[1]}", true]
        ]);

        $this->assertEquals(["new x\n", 'new y'], File::read(...$a));

        File::delete($a[0]);
    }
}
