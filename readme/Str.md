## Str

### append

```php
/**
 * Append the string to the base by using glue if string exists.
 */
public static function append(
    string $base,
    string $str = '',
    string $glue = '/',
): string
```

```php
// Append will add str to base with glue unless str is empty.


Str::append('base', 'str', '-');

// 'base-str'
```

### prepend

```php
/**
 * Prepend the string to the base by using glue if string exists.
 */
public static function prepend(
    string $base,
    string $str = '',
    string $glue = '/',
): string
```

```php
// Prepend will add str to beginning of base with glue unless str is empty.


Str::prepend('base', 'str', '-');

// 'str-base'
```

### inject

```php
/**
 * Inject the string between strings in a squence by using enclose method.
 */
public static function inject(
    string $str = '',
    array|string $glue = '/',
): string
```

```php
// Inject will wrap the string with specified characters.


Str::inject('str', ['[', '(', '<', 'sq']);

// '[(<'str'>)]'
```

### enclose

```php
/**
 * Wrap the given string with the given character.
 */
public static function enclose(string $str, string $glue = '/'): string
```

```php
// Enclose will wrap str with the given character.


Str::enclose('str', '{');

// '{str}'
```

### compare

```php
/**
 * Compare two strings to check if they are the same or the first contains the second.
 */
public static function compare(
    string $str1,
    string $str2,
    string $operator = '=',
): bool
```

```php
// Compare will determine if two strings are equal.


Str::compare('one', 'one', '==');

// true
```

```php
// Compare will determine if the first string contains the second one.


Str::compare('one', 'n', '=');

// true
```

### has

```php
WARNINGS:
- mismatched parameter count

/**
 * Determine if string contains the given value.
 */
public static function has(
    string $str,
    string $search,
    bool $isWordByWord = false,
): bool
```

```php
// Has will determine if the string contains the searhed term.


Str::has('searchable str', 'search', false);

// true
```

```php
// Has will determine if the string has the searced word.


Str::has('searchable str', 'search', true);

// false
```

### hasNot

```php
/**
 * Determine if string contains the given value.
 */
public static function hasNot(string $str, string $search): bool
```

```php
// Has not returns the opposite of has.


Str::hasNot('searchable str', 'search', false);

// false
```

### hasSome

```php
WARNINGS:
- mismatched parameter count

/**
 * Determine if the string contains some of the given values.
 */
public static function hasSome(
    string $str,
    array|string $search,
    bool $isWordByWord = false,
): bool
```

```php
// Has some will determine if the string has at least one of the given
// substrings.


Str::hasSome('searchable str', ['word', 'str']);

// true
```

### hasNone

```php
/**
 * Determine if the string doesn't contain none of the given values.
 */
public static function hasNone(string $str, string|array $search): bool
```

```php
// Has none will return the opposite of has some.


Str::hasNone('searchable str', ['word', 'str']);

// false
```

### hasAll

```php
WARNINGS:
- mismatched parameter count

/**
 * Determine if the string contains some of the given values.
 */
public static function hasAll(
    string $str,
    array $search,
    bool $isWordByWord = false,
): bool
```

```php
// Has all will determine if the all substrings are in the string.


Str::hasAll('searchable str', ['search', 'str'], true);

// false
```

### getTail

```php
/**
 * Get the portion of a string after the separator in the specified length as a string or array.
 */
public static function getTail(
    string $str,
    string $seperator = '/',
    int $length = 1,
    bool $isStr = true,
): array<string>|bool|string
```

```php
// Get tail will return the last part of string in the given length.


Str::getTail('one two three four five', ' ', 2);

// 'four five'
```

### dropTail

```php
/**
 * Remove the tail from the string.
 */
public static function dropTail(
    string $value = '',
    string $seperator = '/',
    int $length = 1,
): string
```

```php
// Drop tail will remove the last part of the string in  the given length.


Str::dropTail('one/two/three/four/five', '/', 3);

// 'one/two'
```

### changeTail

```php
WARNINGS:
- mismatched type count

/**
 * Replace the tail of the string with the given one.
 */
public static function changeTail(
    string $str,
    array|string $add,
    string $glue = '/',
    int $length = 1,
): string
```

```php
// Change tail will replace the last part of the string with the given string.


Str::changeTail('one.two.three.four.five', 5, '.', 2);

// 'one.two.three.5'
```

### separateTail

```php
/**
 */
public static function separateTail(
    string $value = '',
    string $seperator = '/',
    int $length = 1,
)
```

```php
// Separate tail will divide string two parts based on glue and length.


Str::separateTail('one_two_three_four_five', '_', 2);

// ['one_two_three', 'four_five']
```

### trim

```php
/**
 */
public static function trim(
    string $string,
    string $characters = '',
    bool $append = true,
): string
```

```php
// Trim will trim string with give characters and default ones.


Str::trim(' * one two three.', '*.', true);

// 'one two three'
```

### format

```php
/**
 */
public static function format(
    string $method,
    array|string $words,
    string $glue = '-',
): array
```

```php
// Format will apply formatter method to each string in array.


Str::format('ucfirst', ['one', 'two', 'three']);

// ['One', 'Two', 'Three']
```

```php
// Format will apply formatter to each word in string based on glue.


Str::format('ucfirst', 'one_two-three.four', '-');

// ['One_two', 'Three.four']
```