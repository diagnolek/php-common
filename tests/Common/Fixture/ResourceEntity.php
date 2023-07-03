<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Test\Common\Fixture;

use Diagnolek\Common\Model\ColumnEntity;
use Diagnolek\Common\Model\ColumnToPropertyTrait;
use Diagnolek\Common\Model\TableEntity;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;

#[TableEntity('resource')]
class ResourceEntity
{
    use ColumnToPropertyTrait;

    #[ColumnEntity('uid')]
    public string $key;

    #[ColumnEntity('name')]
    public string $value;

    public function __construct(ActiveRecordInterface $record)
    {
        $this->init($record);
    }

}
