<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

use Propel\Runtime\Map\TableMap;
use Diagnolek\Common\Pattern\Builder\ProfileInterface;

trait ProfileTrait
{

    private function getFillableFromInterface(): array
    {
        $fillable = [];
        $r = new \ReflectionClass($this);
        foreach ($r->getInterfaces() as $interface) {
            $parents = $interface->getInterfaces();
            if ($parents) {
                foreach ($parents as $parent) {
                    if ($parent->getName() == ProfileInterface::class) {
                        $methods = array_filter($interface->getMethods(),fn($name)=>preg_match('/(get|set)(.{1,})/', $name));
                        foreach ($methods as $method) {
                            $name = substr($method->getName(),3,strlen($method->getName()));
                            $fillable[] =$name;
                        }
                    }
                }
            }
        }
        return $fillable;
    }

    public function fillable(): array
    {
        return $this->getFillableFromInterface();
    }

    /**
     * @param string $keyType
     * @param bool $includeLazyLoadColumns
     * @param array $alreadyDumpedObjects
     * @param bool $includeForeignObjects
     * @return array
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        $data = [];
        $fillable = $this->fillable();
        if (method_exists(get_parent_class($this), 'toArray')) {
            $fillableLower = array_map(fn($name)=>strtolower($name), $fillable);
            foreach (parent::toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, $includeForeignObjects) as $key => $value) {
                if (in_array(strtolower($key), $fillableLower)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        foreach (get_class_methods($this) as $method) {
            $prefix = substr($method, 0, 3);
            $name = substr($method, 3 , strlen($method));
            if ($prefix == 'get' && in_array($name, $fillable)) {
                $data[$name] = $this->$method();
            }
        }
        return $data;
    }

    /**
     * @param array $arr
     * @param string $keyType
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!is_array($arr)) return;

        $fillable = $this->fillable();
        if (method_exists(get_parent_class($this), 'fromArray')) {
            $fillableLower = array_map(fn($name)=>strtolower($name), $fillable);
            foreach ($arr as $key=>$value) {
                if (!in_array(strtolower($key), $fillableLower)) {
                    unset($arr[$key]);
                }
            }
            parent::fromArray($arr, $keyType);
            return;
        }
        $values = array_change_key_case($arr);
        foreach (get_class_methods($this) as $method) {
            $prefix = substr($method, 0, 3);
            $name = substr($method, 3 , strlen($method));
            if ($prefix == 'set' && in_array($name, $fillable) && isset($values[strtolower($name)])) {
                $this->$method($values[strtolower($name)]);
            }
        }
    }

}
