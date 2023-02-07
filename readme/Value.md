## Value

### compare

```php
/**
 * Compare two values with the specified operator
 */
public static function compare(
    mixed $value1,
    mixed $value2,
    string $operator,
): int|bool
```

```php
// Compare will compare two values based on specified operator.


Value::compare(1, 3, '<');

// true
```