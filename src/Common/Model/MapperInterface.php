<?php

namespace Diagnolek\Common\Model;

interface MapperInterface
{

    public function map(string|array $value): string|array;

    public function addMap(string $src, string $dest): self;

    public function mapping(): array;

}
