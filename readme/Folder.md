## Folder

### copy

```php
/**
 * It will copy the directory to the new destination and return
 * the target path if everything works.
 */
public static function copy(
    string $from,
    string $to,
    ?int $options = null,
): string
```

```php
// Copy will copy the directory.


Folder::copy(
    '/var/www/html/package/tests/TestBase/new_dir', 
    '/var/www/html/package/tests/TestBase/new_dir_2'
);

// '/var/www/html/package/tests/TestBase/new_dir_2'
```

### move

```php
/**
 * It will move the directory to the given path.
 */
public static function move(
    string $from,
    string $to,
    bool $overwrite = false,
): string
```

```php
// Move will move the directory.


Folder::move(
    '/var/www/html/package/tests/TestBase/new_dir', 
    '/var/www/html/package/tests/TestBase/new_dir_2'
);

// true
```

### delete

```php
WARNINGS:
- mismatched parameter count

/**
 * It deletes a directory recursively.
 */
public static function delete(string $path, bool $preserve = false): bool
```

```php
// Delete will delete the directory but and its susstructure.


Folder::delete('/var/www/html/package/tests/TestBase/new_dir');

// The directory has been deleted.
```

### deleteBulk

```php
WARNINGS:
- misplaced parameter

/**
 * It will remove all of the directories within a given directory.
 */
public static function deleteBulk(string $path): bool
```

```php
// Delete bulk do stuff.


Folder::deleteBulk('/var/www/html/package/tests/TestBase/new_dir');

// The directory has been deleted.
```

### deleteChildDirs

```php
WARNINGS:
- misplaced parameter

/**
 * It will remove all of the directories within a given directory.
 */
public static function deleteChildDirs(string $path): bool
```

```php
// Delete child dirs will delete all the subfolders including the dirty ones.


Folder::deleteChildDirs('/var/www/html/package/tests/TestBase/new_dir');

// All directory children of new_dir have been deleted.
```

### clean

```php
/**
 * It will empty the specified directory of all files and folders.
 */
public static function clean(string $path): string
```

```php
// Clean will delete all child items of the directory.


Folder::clean('/var/www/html/package/tests/TestBase/new_dir');

// The directory has been emptied.
```

### complete

```php
WARNINGS:
- mismatched types

/**
 * It will create directories when they are missing.
 */
public static function complete(
    string $path,
    int $mode = 493,
    bool $recursive = true,
): string
```

```php
// Complete will create a new directory when it is missing.


Folder::complete('/var/www/html/package/tests/TestBase/new_dir');

// The missing directory has been created with the name "new_dir."
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

### is

```php
/**
 * It will check if the given ğath is a directory
 */
public static function is(string $path): bool
```

```php
// Is will determine if the specified path is a directory.


Folder::is('/var/www/html/package/tests/TestBase/new_dir');

// true
```

### isNot

```php
/**
 * It will check if the given ğath is a directory
 */
public static function isNot(string $path): bool
```

```php
// Is not will determine if the specified path is a directory.


Folder::isNot('/var/www/html/package/tests/TestBase/new_dir/x.txt');

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

### make

```php
WARNINGS:
- mismatched parameter count

/**
 * It will create a directory on the given path.
 */
public static function make(
    string $path,
    int $mode = 493,
    bool $recursive = false,
    bool $force = false,
): string
```

```php
// Make will make a directory for the given path.


Folder::make('/var/www/html/package/tests/TestBase/new_dir');

// new_dir has been created under TestBase.
// To create multiple directories use Path::complete()
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

### paths

```php
/**
 * It will return all paths on a directory including files and empty folders.
 */
public static function paths(
    string $path,
    array|callable|string|null $callback = null,
): array
```

```php
// Paths will return a path list of files and empty folders on a directory and
// its subdirectories.


Folder::paths('/var/www/html/package/tests/TestBase');

// ['/var/www/html/package/tests/TestBase/a', '/var/www/html/package/tests/TestBase/a/a.php', '/var/www/html/package/tests/TestBase/a/c', '/var/www/html/package/tests/TestBase/a/c/c.php', '/var/www/html/package/tests/TestBase/b', '/var/www/html/package/tests/TestBase/b/b.php', '/var/www/html/package/tests/TestBase/empty1', '/var/www/html/package/tests/TestBase/empty1/sub-empty', '/var/www/html/package/tests/TestBase/empty2', '/var/www/html/package/tests/TestBase/x.php', '/var/www/html/package/tests/TestBase/y.php', '/var/www/html/package/tests/TestBase/z.php']
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