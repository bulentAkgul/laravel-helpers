## Folder

### content

```php
/**
 * It returns the list of names of the folders and files on the given path
 * after excluding the items that passed in argument.
 */
public static function content(string $path, array $exclude = []): array
```

```php
// Content will return a list of files and directories on a folder.


Folder::content(
    '/var/www/html/packages/laravel-helpers/tests/TestBase', 
    ['y.php']
);

// ['2' => 'a', '3' => 'b', '4' => 'x.php', '6' => 'z.php']
```

### contains

```php
/**
 * It determines if the item in folder.
 */
public static function contains(string $path, array|string $name): bool
```

```php
// Contains will determine if the searched item is on the folder.


Folder::contains(
    '/var/www/html/packages/laravel-helpers/tests/TestBase', 
    ['a', 'y.php']
);

// true
```

### files

```php
WARNINGS:
- missmatched nullable types

/**
 * It returns the list of paths of files under the specified folder including its subfolders.
 */
public static function files(
    string $path,
    callable|array|string|null $callback = null,
): array
```

```php
// Files will return a path list of files on a folder and its subfolders.


Folder::files('/var/www/html/packages/laravel-helpers/tests/TestBase');

// ['/var/www/html/packages/laravel-helpers/tests/TestBase/a/a.php', '/var/www/html/packages/laravel-helpers/tests/TestBase/a/c/c.php', '/var/www/html/packages/laravel-helpers/tests/TestBase/b/b.php', '/var/www/html/packages/laravel-helpers/tests/TestBase/x.php', '/var/www/html/packages/laravel-helpers/tests/TestBase/y.php', '/var/www/html/packages/laravel-helpers/tests/TestBase/z.php']
```

### name

```php
/**
 * It creates a folder name based on PSR convintion.
 */
public static function name(
    string $value,
    string $suffix = '',
    string $prefix = '',
    bool $isSingular = false,
): string
```

```php
// Name will create a folder name with given parts by converting them.


Folder::name('user', 'service', 'authenticated', false);

// 'AuthenticatedUserServices'
```

### tree

```php
/**
 * It creates a file/folder structure of the specified folder
 * and its subfolders in a nested associative array.
 */
public static function tree(string $path): array
```

```php
// Tree will generate a path list of files in a multidimentional array.


Folder::tree('/var/www/html/packages/laravel-helpers/tests/TestBase');

// ['a' => ['a.php' => '/var/www/html/packages/laravel-helpers/tests/TestBase/a/a.php', 'c' => ['c.php' => '/var/www/html/packages/laravel-helpers/tests/TestBase/a/c/c.php']], 'b' => ['b.php' => '/var/www/html/packages/laravel-helpers/tests/TestBase/b/b.php'], 'x.php' => '/var/www/html/packages/laravel-helpers/tests/TestBase/x.php', 'y.php' => '/var/www/html/packages/laravel-helpers/tests/TestBase/y.php', 'z.php' => '/var/www/html/packages/laravel-helpers/tests/TestBase/z.php']
```

### refresh

```php
/**
 * It deletes the items in a folder or create the folder unless it exists.
 */
public static function refresh(mixed $path): bool
```

```php
// Refresh will delete all items in a folder or create one unless it exists.


Folder::refresh('/var/www/html/packages/laravel-helpers/tests/TestBase/b');

// true
```

### add

```php
/**
 */
public static function add(
    string $path,
    string $file,
    string $content = '',
): void
```

```php
// Add fill create a file in a given folder after creating missing folders on
// the path.


Folder::add(
    '/var/www/html/packages/laravel-helpers/tests/TestBase/new/newer/newest', 
    'x.php', 
    'new x'
);

// null
```