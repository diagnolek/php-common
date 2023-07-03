<?php

namespace Diagnolek\Common\Domain;

interface DomainQueryInterface
{
    public function __invoke(object $context): ?object;

}
