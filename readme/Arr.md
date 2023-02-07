## Arr

### append

```php
/**
 * It pushes the item to the array by usign dot notation
 */
public static function append(
    array &$array,
    string|int $keys,
    mixed $value,
): void
```

```php
// Append will push the given value to array that associated to given key.


Arr::append(['a' => 1, 'b' => 2, 'c' => [3, 4]], 'c', 5);

// No return value could have been produced.
```

```php
// Append will push the given value to array that associated to given key using
// dot notation.


Arr::append(['a' => 1, 'b' => ['c' => [2, 3]]], 'b.c', 4);

// No return value could have been produced.
```

### carry

```php
/**
 * It determines if the searched string is in the array as keys or values.
 */
public static function carry(
    array $array,
    mixed $search,
    bool $isKey = true,
): bool
```

```php
// Carry will determine if the array has the key.


Arr::carry(['a' => 1, 'b' => 2, 'c' => 3], 'b');

// true
```

```php
// Carry will determine if the array has the keys.


Arr::carry(['a' => 1, 'b' => 2, 'c' => 3], ['b', 'c']);

// true
```

```php
// Carry will determine if the array has the nested key.


Arr::carry(
    ['a' => 1, 'b' => 2, 'c' => ['d' => ['e' => 3, 'f' => 4]]], 
    'c.d.f'
);

// true
```

```php
// Carry will determine if the array has the value.


Arr::carry(['a' => 1, 'b' => 2, 'c' => 3], 2, false);

// true
```

```php
// Carry will determine if the array has the values.


Arr::carry(['a' => 1, 'b' => 2, 'c' => 3], [2, 3], false);

// true
```

### hasAll

```php
/**
 * It checkes if the array has all of the searched items on keys or values or both.
 */
public static function hasAll(
    array $array,
    array $search,
    bool $isKey = false,
): bool
```

```php
// Has all will determine if all terms in array as keys by using dot notation.


Arr::hasAll(
    ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], 
    ['a', 'c.d'], 
    true
);

// true
```

```php
// Has all will determine if all terms in arrays as values.


Arr::hasAll(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], [1, 2]);

// true
```

### hasAt

```php
/**
 * It finds the key of the items that is equals to seached value.
 */
public static function hasAt(array $array, mixed $search): string|int|null
```

```php
// Has at will return the key or index of the value from the array.


Arr::hasAt(['a' => 1, 'b' => 2, 'c' => 3], 2);

// 'b'
```

```php
// Has not will return the opposite of carry.


Arr::hasAt(['a' => 1, 'b' => 2, 'c' => 3], 'd');

// null
```

### hasSome

```php
/**
 * It determines if any of the searched terms in array's keys or values.
 */
public static function hasSome(
    array $array,
    array $search,
    bool $isKey = false,
): bool
```

```php
// Has some will determine if some of the searched items among the keys of
// array.


Arr::hasSome(['a' => 1, 'b' => 2, 'c' => 3], ['a', 'd'], true);

// true
```

```php
// Has some will determine if some of the searched items among the values of
// array.


Arr::hasSome(['a' => 1, 'b' => 2, 'c' => 3], [2, 5]);

// true
```

### hasNone

```php
/**
 * It returns opposite of hasSome
 */
public static function hasNone(
    array $array,
    array $search,
    bool $isKey = false,
): bool
```

```php
// Has none will return the opposite of has some.


Arr::hasNone(['a' => 1, 'b' => 2, 'c' => 3], [4, 5]);

// true
```

### combine

```php
/**
 * It combines 2 arrays as key => value by removing extra
 * values or filling the missing values with default one.
 */
public static function combine(
    array $keys,
    array $values = [],
    mixed $default = null,
): array
```

```php
// Combine will generate key value pairs from two arrays.


Arr::combine(['a', 'b', 'c'], [1, 2, 3]);

// ['a' => 1, 'b' => 2, 'c' => 3]
```

```php
// Combine will generate key value pairs from two arrays by filling missing
// values.


Arr::combine(['a', 'b', 'c'], [1, 2], 'x');

// ['a' => 1, 'b' => 2, 'c' => 'x']
```

```php
// Combine will generate key value pairs from two arrays by removing extra
// values.


Arr::combine(['a', 'b'], [1, 2, 3]);

// ['a' => 1, 'b' => 2]
```

### contains

```php
/**
 * It checks if given string is in the array by using str_contains
 */
public static function contains(array $array, string $search): bool
```

```php
// Contains will determine if the given value is a part of the array.


Arr::contains(['apple', 'banana', 'orange'], 'nana');

// true
```

### containsAt

```php
/**
 * It find and returns the key of item that contains the given string.
 */
public static function containsAt(array $array, string $search): ?int
```

```php
// Contains at will return the index or key of item that contains the searched
// term.


Arr::containsAt(['apple', 'banana', 'orange'], 'nana');

// 1
```

### containsOn

```php
/**
 * It returns the item that contains the given string.
 */
public static function containsOn(array $array, string $search): string
```

```php
// Contains on will return the item that contains the searched term.


Arr::containsOn(['apple', 'banana', 'orange'], 'nana');

// 'banana'
```

### delete

```php
/**
 * It deletes the key - value pair in array and returns the array.
 * keys = 0 deletes the first item.
 * keys = -1 deletes the last item.
 * keys = stirng uses dot notation.
 */
public static function delete(
    array $array,
    array|int|float|string $keys = -1,
): array
```

```php
// Delete will remove the specified key from the array and return the array.


Arr::delete(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], 'a');

// ['b' => 2, 'c' => ['d' => 3, 'e' => 4]]
```

```php
// Delete will remove the specified key using dot notation from the array and
// return the array.


Arr::delete(
    ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], 
    ['a', 'c.d']
);

// ['b' => 2, 'c' => ['e' => 4]]
```

### drop

```php
/**
 * It will remove the key from the referenced array
 */
public static function drop(
    mixed &$array,
    array|int|float|string $keys = -1,
): void
```

```php
// Drop will remove the specified key using dot notation from the referenced
// array.


Arr::drop(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], 'a');

// void
```

### find

```php
/**
 * It finds the searched item in array and returns it like
 * [key => the key of the found value, value => the found value]
 * If nothing has found, it returns [key => null, value => null]
 * or null depends on $nullable.
 */
public static function find(
    array $array,
    array|int|float|string $search,
    string $keys = '',
    string $operator = '=',
    bool $nullable = true,
): ?array
```

```php
// Find will return the key and value of the first matched item.


Arr::find(
    [['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]], 
    5, 
    'a'
);

// ['key' => 1, 'value' => ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]]
```

```php
// Find can use dot notation as searched key and different comparison oprators.


Arr::find(
    [['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]], 
    5, 
    'c.d', 
    '<'
);

// ['key' => 0, 'value' => ['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]]]
```

### firstKey

```php
/**
 * It will return the key of what self::find() returns
 */
public static function firstKey(
    array $array,
    array|int|float|string $search,
    string $keys = '',
    string $operator = '=',
): string|int|null
```

```php
// First key will return the key of what find method returns.


Arr::firstKey(
    [['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]], 
    5, 
    'a'
);

// 1
```

### firstValue

```php
/**
 * It will return the value of what self::find() returns
 */
public static function firstValue(
    array $array,
    array|int|float|string $search,
    string $keys = '',
    string $operator = '=',
): mixed
```

```php
// First value will return the value of what find method returns.


Arr::firstValue(
    [['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]], 
    5, 
    'b', 
    ''
);

// No return value could have been produced.
```

### fetch

```php
/**
 * It returns an item from the array based on keys value.
 * keys = 0 returns the first item or default value if array is empty.
 * keys = -1 returns the last item or default value if array is empty.
 * keys = stirng uses dot notation.
 */
public static function fetch(
    array $array,
    array|string|int $keys = '',
    mixed $default = null,
): mixed
```

```php
// Fetch will return an item that is associated to given key from the array.


Arr::fetch(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], 'a');

// 1
```

```php
// Fetch can return multiple vales with multiple keys.


Arr::fetch(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], ['a', 'b']);

// ['a' => 1, 'b' => 2]
```

```php
// Fetch will return the first value when the key is zero.


Arr::fetch(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], 0);

// 1
```

```php
// Fetch will return the last value when the key is opposite one.


Arr::fetch(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], -1);

// ['d' => 3, 'e' => 4]
```

### group

```php
/**
 * It groups the items in array by the values of the given keys.
 */
public static function group(array $array, array|int|string $keys): array
```

```php
// Group will create a groupped array of given key.


Arr::group(
    [['city' => 'Istanbul', 'name' => 'Bulent'], ['city' => 'Istanbul', 'name' => 'Ozan'], ['city' => 'Istanbul', 'name' => 'Elif'], ['city' => 'Istanbul', 'name' => 'Sibel'], ['city' => 'Ankara', 'name' => 'Sinan'], ['city' => 'Ankara', 'name' => 'Burak'], ['city' => 'Ankara', 'name' => 'Canan'], ['city' => 'Ankara', 'name' => 'Hilal']], 
    'city'
);

// ['Istanbul' => [['city' => 'Istanbul', 'name' => 'Bulent'], ['city' => 'Istanbul', 'name' => 'Ozan'], ['city' => 'Istanbul', 'name' => 'Elif'], ['city' => 'Istanbul', 'name' => 'Sibel']], 'Ankara' => [['city' => 'Ankara', 'name' => 'Sinan'], ['city' => 'Ankara', 'name' => 'Burak'], ['city' => 'Ankara', 'name' => 'Canan'], ['city' => 'Ankara', 'name' => 'Hilal']]]
```

```php
// Group will create a nested array based on given keys.


Arr::group(
    [['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Bulent'], ['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Ozan'], ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Elif'], ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Sibel'], ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Sinan'], ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Burak'], ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Canan'], ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Hilal']], 
    ['city', 'gender']
);

// ['Istanbul' => ['male' => [['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Bulent'], ['city' => 'Istanbul', 'gender' => 'male', 'name' => 'Ozan']], 'female' => [['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Elif'], ['city' => 'Istanbul', 'gender' => 'female', 'name' => 'Sibel']]], 'Ankara' => ['male' => [['city' => 'Ankara', 'gender' => 'male', 'name' => 'Sinan'], ['city' => 'Ankara', 'gender' => 'male', 'name' => 'Burak']], 'female' => [['city' => 'Ankara', 'gender' => 'female', 'name' => 'Canan'], ['city' => 'Ankara', 'gender' => 'female', 'name' => 'Hilal']]]]
```

### in

```php
/**
 * It determines if the seached terms are in the array.
 */
public static function in(array $array, mixed $search): bool
```

```php
// In will determine if the searched item among the array values.


Arr::in([1, 2, 3], 2);

// true
```

```php
// In will determine if the searched items among the array values.


Arr::in(['a' => 1, 'b' => 2, 'c' => 3], [2, 3]);

// true
```

### out

```php
/**
 * It returns the opposite of Arr::in().
 */
public static function out(array $array, string $search): bool
```

```php
// Out will return the opposite of in.


Arr::out([1, 2, 3], 4);

// true
```

### isEqual

```php
/**
 * It checks if two arrays are equal in terms of the given keys.
 */
public static function isEqual(
    array $src,
    array $check,
    array $keys,
    string $mode = 'and',
): bool
```

```php
// Is equal will determine if the given two arrays are equal based on all of
// the given keys.


Arr::isEqual(
    ['a' => 1, 'b' => 2, 'c' => 3], 
    ['a' => 1, 'b' => 2, 'c' => 4], 
    ['a', 'b']
);

// true
```

```php
// Is equal will determine if the given two arrays are equal based on the
// equality of at least one of the given keys.


Arr::isEqual(
    ['a' => 1, 'b' => 2, 'c' => 3], 
    ['a' => 1, 'b' => 2, 'c' => 4], 
    ['a', 'c'], 
    'or'
);

// true
```

### isNotEqual

```php
/**
 */
public static function isNotEqual(
    array $src,
    array $check,
    array $keys,
    string $mode = 'and',
): bool
```

```php
// Is not equal will return the opposite of is equal.


Arr::isNotEqual(
    ['a' => 1, 'b' => 2, 'c' => 3], 
    ['a' => 1, 'b' => 2, 'c' => 4], 
    ['a', 'c']
);

// true
```

### mapAssoc

```php
/**
 * It execute a map action with given callback on an associative array
 * while it can assign the values to a new set of keys.
 */
public static function mapAssoc(
    array $array,
    ?callable $callback = null,
    array $keys = [],
): array
```

```php
// Map assoc will perform a map action with given callback.


Arr::mapAssoc(['a' => 1, 'b' => 2, 'c' => 3], Closure);

// ['a' => 'a-1', 'b' => 'b-2', 'c' => 'c-3']
```

```php
// Map assoc will perform a map action with given callback and combine results
// with the given keys.


Arr::mapAssoc(['a' => 1, 'b' => 2, 'c' => 3], Closure, ['x', 'y', 'z']);

// ['x' => 'a-1', 'y' => 'b-2', 'z' => 'c-3']
```

### order

```php
/**
 * It sorts a list or associative array by value or keys by using
 * uasort, uksort, usort, ksort, krsort, sort, rsort.
 */
public static function order(
    array $arr,
    bool $mod = true,
    ?callable $callback = null,
): array
```

```php
// Order will sort the list by using sort.


Arr::order([3, 5, 6, 4, 2, 7], true);

// [2, 3, 4, 5, 6, 7]
```

```php
// Order will sort the list by using rsort.


Arr::order([3, 5, 6, 4, 2, 7], false);

// [7, 6, 5, 4, 3, 2]
```

```php
// Order will sort the associative array based on its keys by using ksort.


Arr::order(['b' => 2, 'd' => 4, 'c' => 3, 'a' => 1], true);

// ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]
```

```php
// Order will sort the associative array based on its keys by using krsort.


Arr::order(['b' => 2, 'd' => 4, 'c' => 3, 'a' => 1], false);

// ['d' => 4, 'c' => 3, 'b' => 2, 'a' => 1]
```

```php
// Order will sort the associative array based on the callback by using uasort.


Arr::order(['b' => 3, 'd' => 1, 'c' => 2, 'a' => 4], true, Closure);

// ['d' => 1, 'c' => 2, 'b' => 3, 'a' => 4]
```

```php
// Order will sort the associative array based on the callback by using uksort.


Arr::order(['b' => 3, 'd' => 1, 'c' => 2, 'a' => 4], false, Closure);

// ['a' => 4, 'b' => 3, 'c' => 2, 'd' => 1]
```

```php
// Order will sort the list by callback via usort.

// The second argument has no effect on this execution.

Arr::order(['bbb', 'eeee', 'cc', 'd', 'aaaaa'], true, Closure);

// ['d', 'cc', 'bbb', 'eeee', 'aaaaa']
```

### rand

```php
/**
 * It returns an item or an array of items that selected
 * randomly from the array.
 */
public static function rand(array $array, int $length = 1): mixed
```

```php
// Rand will return a randomly selected item from array.


Arr::rand([1, 2, 3, 4, 5], 1);

// 2
```

```php
// Rand will return a list of randomly selected items from array.


Arr::rand([1, 2, 3, 4, 5], 3);

// [5, 3, 4]
```

### range

```php
/**
 * It creates an array of ranged numbers, but max can be anything
 * between min and max.
 */
public static function range(int $max, int $min = 0): array
```

```php
// Range will create an arrat from min to a value between min and max.


Arr::range(10, 2);

// [2, 3, 4, 5, 6, 7, 8, 9, 10]
```

### resolve

```php
/**
 * It clears falsy values and resets the index.
 */
public static function resolve(array $array, ?callable $callback = null): array
```

```php
// Resolve will return truety values with resetted index.


Arr::resolve([0, 1, 2, 3, '', 4, null, 5]);

// [1, 2, 3, 4, 5]
```

### select

```php
/**
 * Returns an array of specified keys and their values
 */
public static function select(
    array $array,
    array $keys,
    mixed $default = null,
): array
```

```php
// Select will return the specified keys and their values from array by setting
// missing values default.


Arr::select(['a' => 1, 'b' => 2, 'c' => 3], ['a', 'd'], 'x');

// ['a' => 1, 'd' => 'x']
```

### splice

```php
/**
 * It performs array_splice and returns the array.
 */
public static function splice(
    array $array,
    int $offset,
    int $length,
    mixed $replacement = [],
): array
```

```php
// Splice will execute array splice and return the array.


Arr::splice([1, 2, 3, 4, 5], 1, 3, ['a', 'b']);

// [1, 'a', 'b', 5]
```

### prioritize

```php
/**
 * It moves the given set of items to the first section
 * and other items to the last section of the array.
 */
public static function prioritize(array $array, array $priorities): array
```

```php
// Prioritize will bring to front the specified items and then list rest.


Arr::prioritize([1, 2, 3, 4, 5], [2, 4]);

// ['0' => 2, '1' => 4, '2' => 1, '4' => 3, '6' => 5]
```

### unique

```php
/**
 * It returns the unique values of an array after removing
 * falsy values and resetting the index.
 */
public static function unique(array $array): array
```

```php
// Unique will return unique values after resetting indexes.


Arr::unique([1, 2, 2, 3, 4, 5, 5]);

// [1, 2, 3, 4, 5]
```

### value

```php
/**
 * It returns the value of the given key after finding the
 * associative array by using another key value.
 */
public static function value(
    array $array,
    int|float|string $search,
    string $keys = '',
    string $operator = '=',
    string $pluck = '',
): mixed
```

```php
// Value will return the value of the found item in array.


Arr::value(
    [['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => 4]], ['a' => 5, 'b' => 6, 'c' => ['d' => 7, 'e' => 8]]], 
    5, 
    'a', 
    '=', 
    'c'
);

// ['d' => 7, 'e' => 8]
```