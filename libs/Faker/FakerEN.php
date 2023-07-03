<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Lib\Faker;

use Faker\Factory;
use Faker\Generator;

class FakerEN
{
    use FakerTrait;

    private function __construct()
    {
        $this->faker = Factory::create('en_US');
    }

}
