<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\State;

interface StateContextInterface
{

    public function setContext(ContextStateInterface $context): void;

}
