<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

trait PropertyToArrayTrait
{

    public function toArray(): array
    {
        $data = [];
        $r = new \ReflectionClass($this);
        foreach ($r->getProperties() as $property) {
            $name = $property->getName();
            if (isset($this->$name)) {
                $data[$name] = $property->getValue($this);
            }
        }
        return $data;
    }

}
