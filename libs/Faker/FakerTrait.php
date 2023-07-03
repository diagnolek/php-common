<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Lib\Faker;

use Faker\Generator;

trait FakerTrait
{

    private static ?self $instance = null;

    private Generator $faker;

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function generate(): Generator
    {
        return $this->faker;
    }

}
