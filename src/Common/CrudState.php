<?php

namespace Diagnolek\Common;

use MyCLabs\Enum\Enum;

class CrudState extends Enum
{
    const READY = 0;
    const ERROR = 1;
    const FILLED = 2;
    const CREATED = 3;
    const MODIFIED = 4;
    const DELETED = 5;

    private static self $state;

    public array $data = [];

    public static function setState(int $state, array $data = [])
    {
        self::$state = self::from($state);
        self::$state->data = $data;
    }

    public static function getState(): self
    {
        return self::$state;
    }
}
