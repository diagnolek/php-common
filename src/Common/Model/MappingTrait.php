<?php

namespace Diagnolek\Common\Model;

use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

trait MappingTrait
{

    private array $mapping = [];

    public function map(string|array $value, string $dir = 'dest'): string|array
    {
        if (is_array($value)) {
            return match ($dir) {
                'dest' => array_intersect_key($this->mapping, array_flip($value)),
                'src' => array_intersect($this->mapping, $value),
                default => []
            };
        }

        return match($dir) {
            'dest' => $this->mapping[$value] ?? '',
            'src' => array_flip($this->mapping)[$value] ?? '',
            default => ''
        };
    }

    public function addMap(string $src, string $dest): self
    {
        $this->mapping[$src] = $dest;
        return $this;
    }

    public function mapping(): array
    {
        return $this->mapping;
    }

    public function addAsColumns(ModelCriteria $queryPropel): self
    {
        $virtualColumns = $queryPropel->getAsColumns();
        $fieldNames = $queryPropel->getTableMap()::getFieldNames(TableMap::TYPE_COLNAME);
        foreach ($this->mapping as $src => $dest) {
            if (!in_array($src, $fieldNames) && !in_array($src, $virtualColumns) && $src !== $dest) {
                $queryPropel->addAsColumn($dest, $src);
                $this->addMap($dest, $dest);
            }
        }
        return $this;
    }

}
