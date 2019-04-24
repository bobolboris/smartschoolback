<?php

namespace Tests\Unit;

use App\CabinetAdminComponent\Tools\Coordinate;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        echo "\n";

        $c = new Coordinate('Z1');
        $this->assertTrue(true);
    }
}
