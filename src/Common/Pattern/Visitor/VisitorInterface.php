<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Visitor;

interface VisitorInterface
{

    public function visit($item): void;

}
