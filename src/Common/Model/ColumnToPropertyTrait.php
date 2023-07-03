<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

trait ColumnToPropertyTrait
{
    private function init($record): void
    {
        $tableName = "";
        $r = new \ReflectionClass($this);
        if (isset($r->getAttributes()[0])) {
            $table = $r->getAttributes()[0]->newInstance();
            $tableName = $table->getTableName();
        }
        foreach ($r->getProperties() as $property) {
            if(isset($property->getAttributes()[0])) {
                $column = $property->getAttributes()[0]->newInstance();
                if ($column instanceof ColumnEntity) {
                    $property->setValue($this, $column->setRecord($record)->setTable($tableName)->getValue());
                    if ($r->implementsInterface(MapperInterface::class)) {
                        $this->addMap($column->getName(), $property->getName());
                    }
                }
            }
        }
    }

}
