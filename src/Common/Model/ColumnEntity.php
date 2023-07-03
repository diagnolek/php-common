<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Diagnolek\Lib\Faker\Word;
use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ColumnEntity
{

    private ActiveRecordInterface $record;
    private string $table;

    public function __construct(private string $columnName){}

    public function setRecord(ActiveRecordInterface $record): ColumnEntity
    {
        $this->record = $record;
        return $this;
    }

    public function setTable(string $tableName): ColumnEntity
    {
        $this->table = $tableName;
        return $this;
    }

    private function checkTable(): void
    {
        if (!empty($this->table)) {
            $tableMap = $this->record::TABLE_MAP;
            $tableName = $tableMap::TABLE_NAME;
            if ($tableName != $this->table) throw new \RuntimeException("table name does not match the record");
        }
    }

    public function getValue()
    {
        $this->checkTable();
        $method = 'get'.Word::camelize($this->columnName);
        if (method_exists($this->record, $method)) {
            return $this->record->$method();
        }
        return null;
    }

    public function getName(): string
    {
        $this->checkTable();
        $columnName = Word::camelize($this->columnName);
        return !empty($this->table) ? $this->table.'.'.$columnName : $columnName;
    }

}
