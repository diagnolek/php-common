<?php

namespace Diagnolek\Test\Common;

use Diagnolek\Common\Model\GetterToArrayTrait;
use PHPUnit\Framework\TestCase;

class GetterToArrayTest extends TestCase
{

    public function testCastingGetterToArray(): void
    {
        //given
        $obj = $this->getObjectWithGetter("test1", 10);

        //when
        $arr = $obj->toArray();

        //then
        $this->assertTrue(
            isset($arr['carModel']) && isset($arr['number'])
        );
        $this->assertTrue(
            $arr['carModel'] == 'test1' && $arr['number'] == 10
        );
    }

    public function testGetterToArraySnakeFormat(): void
    {
        //given
        $obj = $this->getObjectWithGetter("test2", 5);

        //when
        $arr = $obj->toArray(keyType: "snake");

        //then
        $this->assertTrue(
            !empty($arr['car_model']) && !empty($arr['number'])
        );
    }

    private function getObjectWithGetter(string $model, int $number): object
    {

        return new class ($model, $number) {

            public function __construct(private string $carModel, private int $number){}

            use GetterToArrayTrait;

            public function getCarModel(): string
            {
                return $this->carModel;
            }

            public function getNumber(): int
            {
                return $this->number;
            }

        };
    }

}
