<?php

namespace Diagnolek\Common\Domain;

interface DomainCommandInterface
{
    public function __invoke(object $context): ?DomainCommandInterface;

}
