<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Domain;

interface DomainModelInterface
{
    public function toArray(): array;

    public function fromArray(array $data): void;
}
