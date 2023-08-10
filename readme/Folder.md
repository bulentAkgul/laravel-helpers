## Folder

### make

```php
/**
 * It will create a directory on given path.
 */
public static function make(string $path): string
```

```php
// Make will make a directory for the given path.


Folder::make('/var/www/html/package/tests/TestBase/new_dir');

// new_dir has been created under TestBase.
// To create multiple directories use Path::complete()
```

### get

```php
/**
 * It returns the folder name from config
 */
public static function get(string $folder): string
```

```php
// Get will return the folder name from config.

// config('packagify.folders.dummy') == DummyFolder

Folder::get('dummy');

// 'DummyFolder'
```

### content

```php
/**
 * It returns the list of names of the folders and files on the given path
 * after excluding the items that passed in argument.
 */
public static function content(string $path, array|callable $except = []): array
```

```php
// Content will return a list of files and directories on a folder.


Folder::content('/var/www/html/package/tests/TestBase', ['y.php']);

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


Folder::contains('/var/www/html/package/tests/TestBase', ['a', 'y.php']);

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


Folder::files('/var/www/html/package/tests/TestBase');

// ['/var/www/html/package/tests/TestBase/a/a.php', '/var/www/html/package/tests/TestBase/a/c/c.php', '/var/www/html/package/tests/TestBase/b/b.php', '/var/www/html/package/tests/TestBase/x.php', '/var/www/html/package/tests/TestBase/y.php', '/var/www/html/package/tests/TestBase/z.php']
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


Folder::tree('/var/www/html/package/tests/TestBase');

// ['a' => ['a.php' => '/var/www/html/package/tests/TestBase/a/a.php', 'c' => ['c.php' => '/var/www/html/package/tests/TestBase/a/c/c.php']], 'b' => ['b.php' => '/var/www/html/package/tests/TestBase/b/b.php'], 'x.php' => '/var/www/html/package/tests/TestBase/x.php', 'y.php' => '/var/www/html/package/tests/TestBase/y.php', 'z.php' => '/var/www/html/package/tests/TestBase/z.php']
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


Folder::refresh('/var/www/html/package/tests/TestBase/b');

// true
```

### isEmpty

```php
/**
 * It determines if the folder is empty.
 */
public static function isEmpty(string $path, array $except = []): bool
```

```php
// Is empty will check if the folder is empty.


Folder::isEmpty('/var/www/html/package/tests/TestBase/empty-dir');

// true
```