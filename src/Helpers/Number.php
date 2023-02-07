<?php

namespace Bakgul\LaravelHelpers\Helpers;

class Number
{
    public static function is(mixed $input): bool
    {
        return in_array(gettype($input), ['string', 'integer', 'float', 'double'])
            ? (is_numeric($input) ?: in_array($input, ['integer', 'float', 'double']))
            : false;
    }

    /**
     * Convert the given value to a float with a specified percision.
     * 
     * @param float|int|string $num
     * @param int $percision
     * 
     * @return float
     */
    public static function toFloat(float|int|string $num, int $percision = 2): float
    {
        return (float) number_format((float) $num, $percision);
    }

    /**
     * Convert the given value to int by using powers of ten.
     * 
     * @param float|string $num
     * @param int $percision
     * 
     * @return int
     */
    public static function toInt(float|string $num, int $percision = 2): int
    {
        return round($num * pow(10, $percision));
    }
}
