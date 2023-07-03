<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class TableEntity
{
    public function __construct(private string $tableName){}

    public function getTableName(): string
    {
        return $this->tableName;
    }



}
