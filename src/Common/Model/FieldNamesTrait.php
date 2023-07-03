<?php

namespace Diagnolek\Common\Model;

trait FieldNamesTrait
{

    public static function fieldNames(): array
    {
        $names = [];
        $r = new \ReflectionClass(__CLASS__);
        foreach ($r->getProperties() as $property) {
            $names[] = $property->getName();
        }
        return $names;
    }

}
