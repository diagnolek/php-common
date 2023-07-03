<?php

namespace Diagnolek\Common\Domain;

final class EmptyDomainEvent implements DomainEventInterface
{

    public static function listener(): callable
    {
        return function (){};
    }
}
