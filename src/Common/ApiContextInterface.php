<?php

namespace Diagnolek\Common;

use Interop\Container\ContainerInterface;

interface ApiContextInterface
{
    public function getApiUser(): object;

    public function getServiceManager(): ContainerInterface;

    public function getFilterData(): array;

    public function getSortData(): array;

    public function filter(): array;

    public function getModelData(array $data): object;

}
