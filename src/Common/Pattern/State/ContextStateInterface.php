<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\State;

interface ContextStateInterface
{

    public function setState(StateContextInterface $state): void;

}
