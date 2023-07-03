<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Model;

trait PropertyFromArrayTrait
{

    public function fromArray(array $data): void
    {
        $r = new \ReflectionClass($this);
        foreach ($r->getProperties() as $property) {
            $name = $property->getName();
            if (isset($this->$name) && isset($data[$name])) {
                $this->$name = $data[$name];
            }
        }
    }

}
