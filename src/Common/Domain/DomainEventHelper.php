<?php

namespace Diagnolek\Common\Domain;

use SplStack;

final class DomainEventHelper
{
    private static string $eventName = '';

    public static function checkResponse(SplStack $response, $key = 0)
    {
        if ($response->count() == 0) {
            throw new \RuntimeException("response for ".self::$eventName ." not exist");
        }
        return $response->offsetGet($key);
    }

    public static function event(string $event): string
    {
        self::$eventName = $event;
        return $event;
    }

    public static function typesToArray($value): array
    {
        $type = gettype($value);
        return match ($type) {
            'integer', 'string' => [$value],
            'array' => $value,
            'object' => method_exists($value, 'toArray') ? $value->toArray() : (array) $value,
            default => [],
        };
    }

    public static function hasDomainEventInterface(string $className): bool
    {
        if (empty($className)) return false;
        return (new \ReflectionClass($className))
            ->implementsInterface(DomainEventInterface::class);
    }

    public static function hasToArrayMethod(string $className): bool
    {
        if (empty($className)) return false;
        return (new \ReflectionClass($className))
            ->hasMethod('toArray');
    }

    public static function insertDataToSetter(object $obj, array $data): void
    {
        foreach ($data as $name => $value) {
            $method = "set$name";
            if (method_exists($obj, $method)) {
                $obj->$method($value);
            }
        }
    }

}
