<?php

namespace Bakgul\LaravelHelpers\Tests\PackageTests;

use Bakgul\LaravelHelpers\Helpers\Convention;
use Bakgul\LaravelHelpers\Tests\TestCase;

class ConventionHelperTest extends TestCase
{
    protected function toReadme(array $props): void
    {
        parent::toReadme([
            'class' => Convention::class,
            'test' => debug_backtrace()[1]['function'],
            ...$props
        ]);
    }

    /** @test */
    public function it_will_create_a_singular_name_when_is_singular_is_true(): void
    {
        $name = 'user-services';

        $this->toReadme([
            'method' => 'class',
            'args' => [$name, true],
        ]);

        $this->assertEquals('UserService', Convention::class($name, true));
    }

    /** @test */
    public function it_will_create_a_plural_name_when_is_singular_is_false(): void
    {
        $args = ['user-service', false];

        $this->toReadme([
            'method' => 'table',
            'args' => $args,
        ]);

        $this->assertEquals('user_services', Convention::table(...$args));
    }

    /** @test */
    public function it_will_create_a_name_by_using_provided_value_as_it_is_when_is_singular_is_null(): void
    {
        $args = ['user-services', null];

        $this->toReadme([
            'method' => 'var',
            'args' => $args,
        ]);

        $this->assertEquals('userServices', Convention::var(...$args));
    }

    /** @test */
    public function class_will_convert_string_to_the_singular_pascal_case_as_default(): void
    {
        $name = 'store-user-service';

        $this->toReadme([
            'method' => 'class',
            'args' => [$name],
        ]);

        $this->assertEquals('StoreUserService', Convention::class($name));
    }

    /** @test */
    public function namespace_will_convert_string_to_the_plural_pascal_case_as_default(): void
    {
        $name = 'store-user-service';

        $this->toReadme([
            'method' => 'namespace',
            'args' => [$name],
        ]);

        $this->assertEquals('StoreUserServices', Convention::namespace($name));
    }

    /** @test */
    public function method_will_convert_string_to_the_camel_case_as_default(): void
    {
        $name = 'store-users';

        $this->toReadme([
            'method' => 'camel',
            'args' => [$name],
        ]);

        $this->assertEquals('storeUsers', Convention::camel($name));
    }

    /** @test */
    public function var_will_convert_string_to_the_singular_camel_case_as_default(): void
    {
        $name = 'store-users';

        $this->toReadme([
            'method' => 'var',
            'args' => [$name],
        ]);

        $this->assertEquals('storeUser', Convention::var($name));
    }

    /** @test */
    public function table_will_convert_string_to_the_plural_snake_case_as_default(): void
    {
        $name = 'store-user';

        $this->toReadme([
            'method' => 'table',
            'args' => [$name],
        ]);

        $this->assertEquals('store_users', Convention::table($name));
    }

    /** @test */
    public function affix_will_convert_string_to_the_singular_pascal_case_as_default(): void
    {
        $name = 'user-services';

        $this->toReadme([
            'method' => 'affix',
            'args' => [$name],
        ]);

        $this->assertEquals('UserService', Convention::affix($name));
    }

    /** @test */
    public function folder_will_convert_string_to_the_pascal_case_as_default(): void
    {
        $name = 'user-services';

        $this->toReadme([
            'method' => 'affix',
            'args' => [$name],
        ]);

        $this->assertEquals('UserService', Convention::affix($name));
    }

    /** @test */
    public function convert_will_convert_the_string_to_the_specified_case(): void
    {
        $args = ['user-services', 'camel', true];

        $this->toReadme([
            'method' => 'convert',
            'args' => $args,
        ]);

        $this->assertEquals('userService', Convention::convert(...$args));
    }

    /** @test */
    public function kebab_will_create_a_kebab_case_string(): void
    {
        $name = 'userServices';

        $this->toReadme([
            'method' => 'kebab',
            'args' => [$name],
        ]);

        $this->assertEquals('user-services', Convention::kebab($name));
    }

    /** @test */
    public function snake_will_create_a_snake_case_string(): void
    {
        $name = 'UserService';

        $this->toReadme([
            'method' => 'snake',
            'args' => [$name],
        ]);

        $this->assertEquals('user_service', Convention::snake($name));
    }

    /** @test */
    public function pascal_will_create_a_pascal_case_string(): void
    {
        $name = 'user_services';

        $this->toReadme([
            'method' => 'pascal',
            'args' => [$name],
        ]);

        $this->assertEquals('UserServices', Convention::pascal($name));
    }

    /** @test */
    public function camel_will_create_a_camel_case_string(): void
    {
        $name = 'user_services';

        $this->toReadme([
            'method' => 'camel',
            'args' => [$name],
        ]);

        $this->assertEquals('userServices', Convention::camel($name));
    }
}
