<?php

namespace Bakgul\LaravelHelpers\Helpers;

class Value
{
    /**
     * Compare two values with the specified operator
     * 
     * @param mixed $value1
     * @param mixed $value2
     * @param string $operator
     * @return bool|int
     */
    public static function compare(mixed $value1, mixed $value2, string $operator): bool|int
    {
        return match ($operator) {
            '=' => $value1 == $value2,
            '==' => $value1 === $value2,
            '!' => $value1 != $value2,
            '!=' => $value1 !== $value2,
            '<>' => $value1 <=> $value2,
            '>' => $value1 > $value2,
            '<' => $value1 < $value2,
            '>=' => $value1 >= $value2,
            '<=' => $value1 <= $value2,
        };
    }
}
