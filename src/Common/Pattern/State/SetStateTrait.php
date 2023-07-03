<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\State;

trait SetStateTrait
{
    private ?StateContextInterface $state;

    public function setState(StateContextInterface $state): void
    {
        $this->state = $state;
    }

}
