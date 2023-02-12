## Path

### base

```php
/**
 * Create path from an array and append it to base path.
 */
public static function base(array $parts, string $glue = '/'): string
```

```php
// Base will implode array as path and append to base path.


Path::base(['services', 'user-services']);

// '/var/www/html/services/user-services'
```

### glue

```php
/**
 * Create a path from an array.
 */
public static function glue(array $parts, string $glue = '/'): string
```

```php
// Glue will convert array to path.


Path::glue(['services', 'user-services']);

// 'services/user-services'
```

### adapt

```php
/**
 * Set the correct directory separator.
 */
public static function adapt(string $path): string
```

```php
// Adapt will replace slashes to directory seperator.


Path::adapt('services\user-services\subfolder');

// 'services/user-services/subfolder'
```

### contains

```php
/**
 * Determine if the path contains the searched item or all items.
 */
public static function contains(array|string $path, array|string $search): bool
```

```php
// Contains will determine if the given terms are in the path.


Path::contains('sub1/sub2/sub3/sub4', ['sub1', 'sub3']);

// true
```

### complete

```php
/**
 * Creates missing directories on the path.
 */
public static function complete(string $path): void
```

```php
// Complete will create missing folders in the given path.


Path::complete('/var/www/html/package/tests/TestBase/sub1/sub2/sub3');

// 
```

### serialize

```php
/**
 * Convert path to array with or without base path.
 */
public static function serialize(string $path, bool $withoutBase = false): array
```

```php
// Serialize will explode path with directory seperator.


Path::serialize(
    '/var/www/html/services/user-services/authenticated-user-services'
);

// ['', 'var', 'www', 'html', 'services', 'user-services', 'authenticated-user-services']
```

### baseless

```php
/**
 * Removes base path from the given path.
 */
public static function baseless(string $path): string
```

```php
// Baseless will remove base path from path.


Path::baseless('/var/www/html/services/user-services');

// 'services/user-services'
```

### toNamespace

```php
/**
 * Convert path tp namespace
 */
public static function toNamespace(string|array $path): string
```

```php
// To namespace will create a namespace out of path.


Path::toNamespace('users/user-services/index-user-services');

// 'Users\UserServices\IndexUserServices'
```