<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

use Diagnolek\Lib\Faker\Word;

trait GetterToArrayTrait
{

    public function toArray(string $keyType = 'camelName', $includeLazyLoadColumns = true, $alreadyDumpedObjects = [], $includeForeignObjects = false): array
    {
        $arr = [];
        $r = new \ReflectionClass($this);
        $methods = array_filter($r->getMethods(),fn($name)=>preg_match('/(get)(.{1,})/', $name));
        foreach ($methods as $method) {
            $fn = $method->getName();
            $key = substr($fn,3,strlen($fn));
            if ($r->implementsInterface(MapperInterface::class)) {
                $map = array_search(lcfirst($key), $this->mapping());
                $key = $map !== false ? $this->mapping()[$map] : $key;
            } elseif ($keyType == 'camelName') {
                $key = lcfirst($key);
            } elseif ($keyType == 'fieldName' || $keyType == 'snake') {
                $key = Word::decamelize($key);
            }
            $arr[$key] = $this->fromValue($this->$fn(), $keyType);
        }
        return $arr;
    }

    private function fromValue(mixed $value, string $keyType = 'camelName'): mixed
    {
        if (is_object($value) && method_exists($value, 'toArray')) {
            $arr = [];
            foreach ($value->toArray() as $key=>$val) {
                if ($keyType == 'camelName') {
                    $key = lcfirst($key);
                } elseif ($keyType == 'fieldName' || $keyType == 'snake') {
                    $key = Word::decamelize($key);
                }
                if ($this instanceof MapperInterface) {
                    $key = $this->map($key) ?: $key;
                }
                $arr[$key]=$val;
            }
            return $this->fromValue($arr, $keyType);
        }
        return $value;
    }

}
