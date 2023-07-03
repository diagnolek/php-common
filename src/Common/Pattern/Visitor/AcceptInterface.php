<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Visitor;

interface AcceptInterface
{

    public function accept(VisitorInterface $visitor): void;

}
