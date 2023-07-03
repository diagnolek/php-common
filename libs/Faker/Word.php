<?php

namespace Diagnolek\Lib\Faker;

class Word
{

    public static function camelize(string $input): string
    {
        return str_replace('_', '', ucwords($input, '_'));
    }

    public static function decamelize($string): string
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }

}
