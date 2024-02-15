## Convention

### class

```php
/**
 * It formats the string to create a class name based on Laravel's naming convention.
 */
public static function class(
    string $value,
    ?bool $isSingular = true,
): array|string
```

```php
// It will create a singular name when is singular is true.


Convention::class('user-services', true);

// 'UserService'
```

```php
// Class will convert string to the singular pascal case as default.


Convention::class('store-user-service');

// 'StoreUserService'
```

### table

```php
/**
 * It formats the string to snake case.
 */
public static function table(
    string $value,
    ?bool $isSingular = false,
): array|string
```

```php
// It will create a plural name when is singular is false.


Convention::table('user-service', false);

// 'user_services'
```

```php
// Table will convert string to the plural snake case as default.


Convention::table('store-user');

// 'store_users'
```

### var

```php
/**
 * It formats the string to camel case.
 */
public static function var(
    string $value,
    ?bool $isSingular = true,
): array|string
```

```php
// It will create a name by using provided value as it is when is singular is
// null.


Convention::var('user-services', null);

// 'userServices'
```

```php
// Var will convert string to the singular camel case as default.


Convention::var('store-users');

// 'storeUser'
```

### namespace

```php
/**
 * It formats the string to create a part of a namespace PSR convention.
 */
public static function namespace(
    string $value,
    ?bool $isSingular = false,
): array|string
```

```php
// Namespace will convert string to the plural pascal case as default.


Convention::namespace('store-user-service');

// 'StoreUserServices'
```

### camel

```php
/**
 * It formats the string to camek case.
 */
public static function camel(
    string $value,
    ?bool $isSingular = null,
    bool $returnArray = false,
): array|string
```

```php
// Method will convert string to the camel case as default.


Convention::camel('store-users');

// 'storeUsers'
```

```php
// Camel will create a camel case string.


Convention::camel('user_services');

// 'userServices'
```

### affix

```php
/**
 * It formats the string to pascal case.
 */
public static function affix(
    string $value,
    ?bool $isSingular = true,
): array|string
```

```php
// Affix will convert string to the singular pascal case as default.


Convention::affix('user-services');

// 'UserService'
```

```php
// Folder will convert string to the pascal case as default.


Convention::affix('user-services');

// 'UserService'
```

### route

```php
/**
 * It formats the string to plural kebab case.
 */
public static function route(string $value, ?bool $isSingular = false): string
```

```php
// Convention will format string to the plural kebab case.


Convention::route('UserService');

// 'user-services'
```

### convert

```php
WARNINGS:
- mismatched type count

/**
 * It formats the string to the specified case.
 */
public static function convert(
    string $value,
    ?string $case = null,
    string|bool|null $isSingular = null,
): string
```

```php
// Convert will convert the string to the specified case.


Convention::convert('user-services', 'camel', true);

// 'userService'
```

### kebab

```php
/**
 * It formats the string to kebab case.
 */
public static function kebab(
    string $value,
    ?bool $isSingular = null,
    bool $returnArray = false,
): array|string
```

```php
// Kebab will create a kebab case string.


Convention::kebab('userServices');

// 'user-services'
```

### snake

```php
/**
 * It formats the string to snake case.
 */
public static function snake(
    string $value,
    ?bool $isSingular = null,
    bool $returnArray = false,
): array|string
```

```php
// Snake will create a snake case string.


Convention::snake('UserService');

// 'user_service'
```

### pascal

```php
/**
 * It formats the string to pascal case.
 */
public static function pascal(
    string $value,
    ?bool $isSingular = null,
    bool $returnArray = false,
): array|string
```

```php
// Pascal will create a pascal case string.


Convention::pascal('user_services');

// 'UserServices'
```