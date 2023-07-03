<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

trait CloneTrait
{
    public static function clone(): self
    {
        return clone new self();
    }

}
