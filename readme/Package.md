## Package

### container

```php
/**
 */
public static function container(): string
```

```php
// Container will return package container path.

// Before calling this method, we set the folder name to
// config('packages.container'). It will return 'packages' if you don't set
// anything.

Package::container();

// '/var/www/html/packs'
```

### path

```php
/**
 */
public static function path(string $name, string $tail = ''): ?string
```

```php
// Path will return the package path if it exists.


Package::path('roles');

// '/var/www/html/package/tests/TestBase/packages/core/roles'
```

### list

```php
/**
 */
public static function list(string $root = '', bool $isPath = true): array
```

```php
// List will return a list of package paths in specified root or all roots.


Package::list();

// ['/var/www/html/package/tests/TestBase/packages/core/roles', '/var/www/html/package/tests/TestBase/packages/core/users', '/var/www/html/package/tests/TestBase/packages/features/books', '/var/www/html/package/tests/TestBase/packages/features/posts']
```