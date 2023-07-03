<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Command;

interface ProcessInterface
{

    public function __invoke(object $context): bool;

    public function stop(): bool;

}
