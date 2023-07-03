<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\State;

trait SetContextTrait
{
    private ?ContextStateInterface $context;

    public function setContext(ContextStateInterface $context): void
    {
        $context->setState($this);
        $this->context = $context;
    }

}
