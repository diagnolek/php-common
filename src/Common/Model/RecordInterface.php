<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;

interface RecordInterface
{
    public function getRecord(): ?ActiveRecordInterface;

    public function setRecord(ActiveRecordInterface $record): void;

}
