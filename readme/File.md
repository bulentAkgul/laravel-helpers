## File

### create

```php
/**
 * It creates missing folders on the path and create file on the last directory.
 */
public static function create(
    string $path,
    string $file,
    string $content = '',
): string
```

```php
// Create will create a file with the given content after creating missing
// folders on the path.


File::create(
    '/var/www/html/package/tests/TestBase/new/newer/newest', 
    'x.php', 
    'new x'
);

// a new file created.
```

### read

```php
/**
 * It gets file content and returns as array or string
 */
public static function read(string $path, bool $isArray = false): array|string
```

```php
// Read returns the content of file as string or array.


File::read('/var/www/html/package/tests/TestBase/new/x.txt', true);

// ['new x\n', 'new y']
```