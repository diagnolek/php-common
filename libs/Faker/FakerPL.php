<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Lib\Faker;

use Faker\Factory;
use Faker\Generator;

class FakerPL
{
    use FakerTrait;

    private function __construct()
    {
        $this->faker = Factory::create('pl_PL');
    }

}
