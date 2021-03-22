<?php

use BeeGame\Models\Bee\Drone;
use PHPUnit\Framework\TestCase;

final class DroneTest extends TestCase
{
    public function testQueenType(): void
    {
        $drone = new Drone(100);

        $this->assertEquals('drone', $drone->type());
    }

    public function testDefaultHealthPoints(): void
    {
        $drone = new Drone(100);

        $this->assertEquals(50, $drone->defaultHealthPoints());
    }

    public function testDefaultDamage(): void
    {
        $drone = new Drone(100);

        $this->assertEquals(12, $drone->defaultDamage());
    }
}
