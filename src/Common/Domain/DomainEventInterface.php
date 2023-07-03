<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Domain;

interface DomainEventInterface
{

    public static function listener(): callable;

}
