<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Builder;

interface PrototypeInterface
{

    public function __clone();

    public static function clone();

}
