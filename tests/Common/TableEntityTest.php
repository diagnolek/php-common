<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Test\Common;

use Db\Example\Resource;
use Diagnolek\Lib\Faker\FakerPL;
use Diagnolek\Test\Common\Fixture\ResourceEntity;
use PHPUnit\Framework\TestCase;

class TableEntityTest extends TestCase
{

    public function testGettingValues(): void
    {
        //given
        $uid = FakerPL::getInstance()->generate()->uuid();
        $name = FakerPL::getInstance()->generate()->word();
        $record = (new Resource())
            ->setUid($uid)
            ->setName($name);

        //when
        $entity = new ResourceEntity($record);

        //then
        $this->assertEquals($uid, $entity->key);
        $this->assertEquals($name, $entity->value);
    }

}
