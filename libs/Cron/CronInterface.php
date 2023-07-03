<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Lib\Cron;

interface CronInterface
{

    public function getListedCronjob(): array;

    public function addCronjob($command, $cronTag): array;

    public function removeCronjob($cronTag): bool;

}
