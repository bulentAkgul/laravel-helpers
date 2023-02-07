## Number

### toFloat

```php
/**
 * Convert the given value to a float with a specified percision.
 */
public static function toFloat(float|int|string $num, int $percision = 2): float
```

```php
// To float will convert a number to a float based on percision.


Number::toFloat(1.125531, 3);

// 1.126
```

### toInt

```php
/**
 * Convert the given value to int by using powers of ten.
 */
public static function toInt(float|string $num, int $percision = 2): int
```

```php
// To int will convert a float to integer by multipleying it with the given
// power of ten.


Number::toInt(1.125531, 2);

// 113
```