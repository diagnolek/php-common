<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Command;

use MyCLabs\Enum\Enum;

interface StateInterface
{

    public function state(): Enum;

}
