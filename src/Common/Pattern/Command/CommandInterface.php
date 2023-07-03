<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Command;

interface CommandInterface
{

    public function execute(): bool;

}
