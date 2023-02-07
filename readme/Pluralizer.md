## Pluralizer

### make

```php
/**
 */
public static function make(
    array|string $value,
    array|string $data = '',
    ?bool $isSingular = null,
)
```

```php
// Make will run pluralizer after setting is singular when the second arg is
// array.


Pluralizer::make('service', ['name_count' => 'P']);

// 'services'
```

```php
// Make will run pluralizer after setting is singular.


Pluralizer::make('service', '', false);

// 'services'
```

### run

```php
/**
 */
public static function run(
    array|string $value,
    ?bool $isSingular = null,
): array|string
```

```php
// Run will convert str to plural or singular.


Pluralizer::run('models', null);

// 'models'
```

### set

```php
/**
 */
public static function set(
    array|string $data,
    string $key = 'name_count',
): ?bool
```

```php
// Set will make is singular setting.


Pluralizer::set(['count' => 'P'], 'count');

// false
```