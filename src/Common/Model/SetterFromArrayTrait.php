<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

use Diagnolek\Lib\Faker\Word;

trait SetterFromArrayTrait
{

    public function fromArray(array $data, string $keyType = 'camelName'): void
    {
        $r = new \ReflectionClass($this);
        $methods = array_filter($r->getMethods(),fn($name)=>preg_match('/(set)(.{1,})/', $name));
        foreach ($methods as $method) {
            $fn = $method->getName();
            $key = substr($fn,3,strlen($fn));
            if ($r->implementsInterface(MapperInterface::class)) {
                $map = $this->map(lcfirst($key), 'src');
                if (str_contains($map,'.')) {
                    $column = explode('.', $map);
                    $map = ucfirst(Word::camelize($column[1]));
                }
                $key = $map ?: $key;
            } elseif ($keyType == 'camelName') {
                $key = lcfirst($key);
            } elseif ($keyType == 'fieldName' || $keyType == 'snake') {
                $key = Word::decamelize($key);
            }
            if (isset($data[$key])) {
                $this->$fn($data[$key]);
            }
        }
    }
}
